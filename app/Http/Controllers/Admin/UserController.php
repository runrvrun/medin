<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;
use Schema;
use Session;
use Validator;
use Hash;
use \Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    use Notifiable;
    private $cols;
    
    public function __construct()
    {
        //setup cols
        $dbcols = Schema::getColumnListing('users');//get all columns from DB
        foreach($dbcols as $key=>$val){
            // add bread props
            $cols[$val] = ['column'=>$val,'dbcolumn'=>$val,
                'caption'=>ucwords(str_replace('_',' ',$val)),
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>1,'A'=>1,'D'=>1
            ];
            // add joined columns, if any
            if($val == 'role_id'){
                $cols['role'] = ['column'=>'role','dbcolumn'=>'roles.role',
                'caption'=>'Role',
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>0,'A'=>0,'D'=>1
                ];
            }
        } 
        // modify defaults
        unset($cols['password']);
        unset($cols['remember_token']);
        $cols['role_id']['caption'] = 'role';
        $cols['role_id']['type'] = 'dropdown';
        $cols['role_id']['dropdown_model'] = 'App\Role';
        $cols['role_id']['dropdown_value'] = 'id';
        $cols['role_id']['dropdown_caption'] = 'role';
        $cols['role_id']['B'] = 0;
        
        $this->cols = $cols;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cols = $this->cols;        
        return view('admin.user.index',compact('cols'));
    }

    public function indexjson()
    {
        return datatables(User::select('users.*','role')->join('roles','role_id','roles.id')->where('role_id',2)->get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.action',compact('dt'));
        })
        ->editColumn('expired_at', function ($user) 
        {
            return date('d-m-Y', strtotime($user->expired_at) );
        })
        ->toJson();
    }

    public function partnerindex()
    {
        $cols = $this->cols;        
        return view('admin.user.index',compact('cols'));
    }

    public function partnerindexjson()
    {
        return datatables(User::select('users.*','role')->join('roles','role_id','roles.id')->where('role_id',2)->where('partner_status','Active')->get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.action',compact('dt'));
        })
        ->editColumn('expired_at', function ($user) 
        {
            return date('d-m-Y', strtotime($user->expired_at) );
        })
        ->toJson();
    }

    public function administratorindex()
    {
        $cols = $this->cols;        
        return view('admin.user.index',compact('cols'));
    }

    public function administratorindexjson()
    {
        return datatables(User::select('users.*','role')->join('roles','role_id','roles.id')->where('role_id',1)->get())
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
        $filename = 'medin-user.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/medin-user.csv');
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
        // dd($request->all());
        $user = User::find($userid);
        $request->validate([
            'name' => 'required',
        ]);
        
        $requestData = $request->all();
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }      
        unset($requestData['_method']);
        unset($requestData['_token']);
        unset($requestData['registerpartner']);
        // upload images
        if ($request->hasFile('avatar')) {
            // delete old avatar
            $avatar = $request->file('avatar');
            $name = $user->id.'_avatar_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            $avatar->move(base_path('public/'.$destinationPath), $name);  
            $requestData['avatar']=$destinationPath.'/'.$name;            
        }
        if ($request->hasFile('id_photo')) {
            $avatar = $request->file('id_photo');
            $name = $user->id.'_id_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            $avatar->move(base_path('public/'.$destinationPath), $name);  
            $requestData['id_photo']=$destinationPath.'/'.$name;            
        }
        if ($request->hasFile('company_id_photo')) {
            $avatar = $request->file('company_id_photo');
            $name = $user->id.'_companyid_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            $avatar->move(base_path('public/'.$destinationPath), $name);  
            $requestData['company_id_photo']=$destinationPath.'/'.$name;            
        }
        User::find($userid)->update($requestData);
        if($request->registerpartner){
            return view('admin.user.registerpartnerthankyou');
        }
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
        User::whereRaw('id in ('.$ids.')')->delete();
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

    public function registerpartner()
    {
        $cityprov = \App\City::select(DB::raw("CONCAT(city,', ',province) AS cityprov"),'cities.id')
        ->join('provinces','province_id','provinces.id')->pluck('cityprov','cities.id');
        return view('admin.user.registerpartner',compact('cityprov'));
    }

    public function registerpartnerstore(Request $request)
    {
        # code...
    }

    public function getpartners(Request $request)
    {
        $user = User::where('partner_status','active');
        if(!empty($request->keyword)){
            $user->where('name','like','%'.$request->keyword.'%');
            $user->where(function($q) use($request){
                $q->where('name','like','%'.$request->keyword.'%')
                ->orWhere('company','like','%'.$request->keyword.'%')
                ->orWhere('media','like','%'.$request->keyword.'%');
            });
        }
        if(!empty($request->exclude)){
            $exclude = json_decode($request->exclude,true);
            $user->whereNotIn('id',$exclude);
        }
        return $user->get();
    }
}
