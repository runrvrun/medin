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
use Image;

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
    public function index()
    {
        $cols = $this->cols;        
        return view('admin.user.index',compact('cols'));
    }

    public function indexpartner()
    {
        $cols = $this->cols;
        unset($cols['id_photo']);  
        unset($cols['company_id_photo']);  
        unset($cols['created_at']);  
        unset($cols['updated_at']);  
        unset($cols['email_verified_at']);  
        return view('admin.user.indexpartner',compact('cols'));     
    }

    public function indexjson($x=null)
    {
        $query = User::select('users.*','role','city')
        ->join('roles','role_id','roles.id')
        ->leftJoin('cities','city_id','cities.id')
        ->where('role_id',2);
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.action',compact('dt'));
        })
        ->toJson();
    }

    public function indexpartnerjson($x=null)
    {
        $query = User::select('users.*','role','city')
        ->join('roles','role_id','roles.id')
        ->leftJoin('cities','city_id','cities.id')
        ->where('role_id',2)
        ->whereNotNull('partner_status');
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.actionpartner',compact('dt'));
        })
        ->toJson();
    }

    public function indexadminjson($x=null)
    {
        $query = User::select('users.*')
        ->where('role_id',1);
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.user.actionadmin',compact('dt'));
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
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
            $avatar = $request->file('avatar');
            $name = $user->id.'_avatar_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            // $avatar->move(base_path('public/'.$destinationPath), $name);  
            $image = Image::make($avatar->getRealPath())->resize(120,null, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(120,120)->save(base_path('public/'.$destinationPath).'/'.$name);
            $requestData['avatar']=$destinationPath.'/'.$name;            
        }else{
            $requestData['avatar']='/uploads/avatar/default.jpg';            
        }
        if ($request->hasFile('id_photo')) {
            $avatar = $request->file('id_photo');
            $name = $user->id.'_id_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            // $avatar->move(base_path('public/'.$destinationPath), $name);  
            $image = Image::make($avatar->getRealPath())->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(base_path('public/'.$destinationPath).'/'.$name);
            $requestData['id_photo']=$destinationPath.'/'.$name;            
        }
        if ($request->hasFile('company_id_photo')) {
            $avatar = $request->file('company_id_photo');
            $name = $user->id.'_companyid_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            // $avatar->move(base_path('public/'.$destinationPath), $name);  
            $image = Image::make($avatar->getRealPath())->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(base_path('public/'.$destinationPath).'/'.$name);
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
            if(isset($request->inactive)){
                $requestData['partner_status'] = 'Inactive';
            }
            if(isset($request->active)){
                $requestData['partner_status'] = 'Active';
            }
            unset($requestData['partnerreview']);
            unset($requestData['reject']);
            unset($requestData['approve']);
            unset($requestData['inactive']);
            unset($requestData['active']);
        }
        unset($requestData['_method']);
        unset($requestData['_token']);
        unset($requestData['registerpartner']);
        // upload images
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = $user->id.'_avatar_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            // $avatar->move(base_path('public/'.$destinationPath), $name);
            $image = Image::make($avatar->getRealPath())->resize(120,null, function ($constraint) {
                $constraint->aspectRatio();
            })->crop(120,120)->save(base_path('public/'.$destinationPath).'/'.$name);
            $requestData['avatar']=$destinationPath.'/'.$name;            
            if($user->avatar != '/uploads/avatar/default.jpg'){
                @unlink(base_path('public/'.$user->avatar));// delete old avatar
            }
        }
        if ($request->hasFile('id_photo')) {
            $avatar = $request->file('id_photo');
            $name = $user->id.'_id_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            // $avatar->move(base_path('public/'.$destinationPath), $name);  
            $image = Image::make($avatar->getRealPath())->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(base_path('public/'.$destinationPath).'/'.$name);
            $requestData['id_photo']=$destinationPath.'/'.$name;            
            if($user->id_photo != '/uploads/avatar/default.jpg'){
                @unlink(base_path('public/'.$user->id_photo));// delete old avatar
            }
        }
        if ($request->hasFile('company_id_photo')) {
            $avatar = $request->file('company_id_photo');
            $name = $user->id.'_companyid_'.time().'.'.$avatar->getClientOriginalExtension();
            $destinationPath = 'uploads/avatar';
            // $avatar->move(base_path('public/'.$destinationPath), $name);  
            $image = Image::make($avatar->getRealPath())->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(base_path('public/'.$destinationPath).'/'.$name);
            $requestData['company_id_photo']=$destinationPath.'/'.$name;    
            if($user->company_id_photo != '/uploads/avatar/default.jpg'){
                @unlink(base_path('public/'.$user->company_id_photo));// delete old avatar
            }        
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
            return redirect('admin/partner');
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
                ->orWhere('media','like','%'.$request->keyword.'%');
            });
        }
        if(!empty($request->mediatype) && $request->mediatype !== 'All'){
            $user->where('media_type',$request->mediatype);
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

    public function stoppartner()
    {
        $user = Auth::user();
        $user->update(['partner_status'=>null]);

        Session::flash('message', 'You are no longer a Medin partner, you can re-register as partner anytime'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/myprofile');
    }

    public function deactivate()
    {
        $user = Auth::user();
        $user->update(['partner_status'=>null,'status'=>'Inactive']);

        Session::flush();
        Session::flash('message', 'Account deactivated. Please contact our admin if you want to reactivate your account'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('/');
    }
}
