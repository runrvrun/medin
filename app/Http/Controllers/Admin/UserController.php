<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Session;
use Validator;
use Hash;
use \Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    use Notifiable;
    
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    public function indexjson()
    {
        return datatables(User::get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.action',compact('dt'));
        })
        ->editColumn('expired_at', function ($user) 
        {
            return date('d-m-Y', strtotime($user->expired_at) );
        })
        ->toJson();
    }

    public function csvall()
    {
        $export = User::all();
        $filename = 'vislog-user.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/vislog-user.csv');
        $headers = [
            'Content-Type: text/csv',
            ];
        return response()->download($temp, $filename, $headers)->deleteFileAfterSend(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.createupdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|unique:users',
        ]);

        $requestData = $request->all();
        $date = Carbon::createFromFormat('d/m/Y H:i:s',$requestData['expired_at'].' 00:00:00')->toDateTimeString();
        $requestData['expired_at'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }
        if($requestData['status'] = "on"){
            $requestData['status'] = 1;
        }else{
            $requestData['status'] = 0;
        }
        User::create($requestData);
        Session::flash('message', 'User ditambahkan'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userid)
    {
        $item = user::find($userid);
        return view('admin.user.createupdate',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($userid,Request $request)
    {
        $user = User::find($userid);
        $request->validate([
            'name' => 'required|unique:users,name,'.$user->_id. ',_id',
            'email' => 'required|unique:users,email,'.$user->_id. ',_id',
        ]);
        
        $requestData = $request->all();
        $date = Carbon::createFromFormat('d/m/Y H:i:s',$requestData['expired_at'].' 00:00:00')->toDateTimeString();
        $requestData['expired_at'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }      
        if(isset($requestData['status'])){
            $requestData['status'] = 1;
        }else{
            $requestData['status'] = 0;
        }        
        unset($requestData['_method']);
        unset($requestData['_token']);
        //add comma at end of privileges. fix for TRANS TV also selected by TRANS on filtering
        foreach($requestData['privileges'] as $k=>$p){
            if($k == 'startdate' || $k == 'enddate'){
                //startdate enddate convert to isodate
                $date = Carbon::createFromFormat('Y-m-d H:i:s',$requestData['privileges'][$k].' 00:00:00')->toDateTimeString();
                $requestData['privileges']['iso'.$k] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));        
            }elseif(!empty($p) && substr($p,strlen($p)-1) != ';'){
                //add comma at the end for consistency
                $requestData['privileges'][$k] .= ';';
            }
            $requestData['privileges'][$k] = html_entity_decode($requestData['privileges'][$k]);
        }
        // dd($requestData);
        User::where('_id',$userid)->update($requestData);
        Session::flash('message', 'User diubah'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid)
    {
        User::destroy($userid);
        Session::flash('message', 'User dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }
    
    public function destroymulti(Request $request)
    {
        $ids = htmlentities($request->id);
        User::whereRaw('_id in ('.$ids.')')->delete();
        Session::flash('message', 'User dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user');
    }

    public function hashunhashed()
    {
        $user = User::whereRaw('LENGTH(password) < 20')->get();
        foreach ($user as $val){
            $hashpass = Hash::make($val->password);
            User::find($val->id)->update(['password'=>$hashpass]);
        }
    }

    public function changepassword()
    {
        $token = csrf_token();
        return view('auth.passwords.change',compact('token'));
    }

    public function editpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:4|max:50',
        ]);
        
        $password = Hash::make($request->password);
        User::find(\Auth::user()->id)->update(['password'=>$password]);
                
        Session::flash('message', 'Password changed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin');
    
    }
    public function myprofile()
    {
        return view ('admin.user.myprofile');
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();
        $requestData['name'] = $request->name;
        $requestData['title'] = $request->title;
        $requestData['about'] = $request->about;

        $user->update($requestData);
        return redirect('admin/myprofile');
    }
}
