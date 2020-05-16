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
            if($val == 'city_id'){
                $cols['city'] = ['column'=>'city','dbcolumn'=>'cities.city',
                'caption'=>'City',
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
        $cols['city_id']['caption'] = 'city';
        $cols['city_id']['type'] = 'dropdown';
        $cols['city_id']['dropdown_model'] = 'App\City';
        $cols['city_id']['dropdown_value'] = 'id';
        $cols['city_id']['dropdown_caption'] = 'city';
        $cols['city_id']['B'] = 0;
        
        $this->cols = $cols;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($x=null)
    {
        if($x=='partner'){
            $cols = $this->cols;        
            return view('admin.user.indexpartner',compact('cols'));
        }
        $cols = $this->cols;        
        return view('admin.user.index',compact('cols'));
    }

    public function indexjson($x=null)
    {
        $query = User::select('users.*','role','city')
        ->join('roles','role_id','roles.id')
        ->leftJoin('cities','city_id','cities.id')
        ->where('role_id',2);
        if($x=='partner'){
            $query->whereNotNull('partner_status');
            return datatables($query->get())
            ->addColumn('action', function ($dt) {
                return view('admin.user.actionpartner',compact('dt'));
            })
            ->toJson();
        }
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.action',compact('dt'));
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
        $cityprov = \App\City::select(DB::raw("CONCAT(city,', ',province) AS cityprov"),'cities.id')
        ->join('provinces','province_id','provinces.id')->pluck('cityprov','cities.id');
        return view('admin.user.createupdate',compact('cityprov'));
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
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }
        if($requestData['status'] = "on"){
            $requestData['status'] = 'Active';
        }else{
            $requestData['status'] = 0;
        }
        // upload images
        if ($request->hasFile('avatar')) {
            // delete old avatar
            $avatar = $request->file('avatar');
            $name = $user->id.'_avatar_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            $avatar->move(base_path('public/'.$destinationPath), $name);  
            $requestData['avatar']=$destinationPath.'/'.$name;            
        }else{
            $requestData['avatar']='/uploads/avatar/default.jpg';            
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
        $cityprov = \App\City::select(DB::raw("CONCAT(city,', ',province) AS cityprov"),'cities.id')
        ->join('provinces','province_id','provinces.id')->pluck('cityprov','cities.id');
        return view('admin.user.createupdate',compact('item','cityprov'));
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

        if(!isset($request->partnerreview)){
            $request->validate([
            'name' => 'required',
            ]);
        }
        
        $requestData = $request->all();
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }      
        if(isset($request->partnerreview)){
            if(isset($request->reject)){
                $requestData['partner_status'] = 'Rejected';
            }
            if(isset($request->approve)){
                $requestData['partner_status'] = 'Active';
            }
            unset($requestData['partnerreview']);
            unset($requestData['reject']);
            unset($requestData['approve']);
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
        $user->update($requestData);
        if($request->registerpartner){
            return view('admin.user.registerpartnerthankyou');
        }
        if($request->partnerreview){
            if($request->reject){
                Session::flash('message', 'Partner rejected'); 
            }
            if($request->approve){
                Session::flash('message', 'Partner approved'); 
            }
            Session::flash('alert-class', 'alert-success'); 
            return redirect('admin/user/partner');
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
        return redirect('login');
    
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
    
    public function partnerreview($user_id)
    {
        $item = User::select('users.*',DB::raw("CONCAT(city,', ',province) AS cityprov"))
        ->join('cities','city_id','cities.id')    
        ->join('provinces','province_id','provinces.id')
        ->where('users.id',$user_id)->first();
        return view('admin.user.partnerreview',compact('item'));
    }
}
