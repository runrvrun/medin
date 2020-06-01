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

class AdminController extends Controller
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
        } 
        // modify defaults
        unset($cols['status']);
        unset($cols['role_id']);
        unset($cols['city_id']);
        unset($cols['password']);
        unset($cols['remember_token']);        
        unset($cols['role']);  
        unset($cols['media']);  
        unset($cols['media_type']);  
        unset($cols['partner_status']);  
        unset($cols['id_photo']);  
        unset($cols['company_id_photo']);  
        unset($cols['created_at']);  
        unset($cols['updated_at']);  
        unset($cols['email_verified_at']);  

        
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
        return view('admin.admin.index',compact('cols'));
    }

    public function indexjson($x=null)
    {
        $query = User::where('role_id',1);
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.admin.action',compact('dt'));
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.createupdate');
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
        $requestData['role_id'] = 1;
        $requestData['status'] = 'Active';
        if(!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }        
        User::create($requestData);
        Session::flash('message', 'Admin created'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/admin');
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
        return view('admin.admin.createupdate',compact('item'));
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
        $user->update($requestData);
        Session::flash('message', 'Admin updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/admin');
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
        return redirect('admin/admin');
    }    
}
