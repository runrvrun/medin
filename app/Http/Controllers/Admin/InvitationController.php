<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Schema;
use Session;
use Validator;
use App\Invitation;

class InvitationController extends Controller
{
    private $cols;

    public function __construct()
    {
        //setup cols
        $dbcols = Schema::getColumnListing('invitations');//get all columns from DB
        foreach($dbcols as $key=>$val){
            // add bread props
            $cols[$val] = ['column'=>$val,'dbcolumn'=>$val,
                'caption'=>ucwords(str_replace('_',' ',$val)),
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>1,'A'=>1,'D'=>1
            ];
            // add joined columns, if any
            if($val == 'user_id'){
                $cols['name'] = ['column'=>'name','dbcolumn'=>'users.name',
                'caption'=>'Name',
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>0,'A'=>0,'D'=>1
                ];
            }
            if($val == 'province_id'){
                $cols['province'] = ['column'=>'province','dbcolumn'=>'provinces.province',
                'caption'=>'Province',
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
        return view('admin.invitation.index',compact('cols'));
    }

    public function indexjson()
    {
        return datatables(Invitation::select('invitations.*','name')
        ->leftJoin('users','user_id','users.id')
        )->addColumn('action', function ($dt) {
            return view('admin.invitation.action',compact('dt'));
        })
        ->toJson();
    }

    public function csvall()
    {
        $export = Invitation::all();
        $filename = 'medin-invitation.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/medin-invitation.csv');
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
        $cols = $this->cols;        
        return view('admin.invitation.createupdate',compact('cols'));
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
            'invitation' => 'required',
        ]);

        $requestData = $request->all();
        Invitation::create($requestData);
        Session::flash('message', 'Invitation added'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/invitation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        $cols = $this->cols;        
        $item = Invitation::find($invitation->id);
        return view('admin.invitation.createupdate',compact('cols','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitation $invitation)
    {
        $request->validate([
            'invitation' => 'required|unique:invitations,invitation,'.$invitation->id,
        ]);

        $requestData = $request->all();
        Invitation::find($invitation->id)->update($requestData);
        Session::flash('message', 'Invitation updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/invitation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        Invitation::destroy($invitation->id);
        Session::flash('message', 'Invitation removed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/invitation');
    }
}
