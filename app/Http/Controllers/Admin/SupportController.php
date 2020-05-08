<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Schema;
use Session;
use Validator;
use App\Support;

class SupportController extends Controller
{
    private $cols;

    public function __construct()
    {
        //setup cols
        $dbcols = Schema::getColumnListing('supports');//get all columns from DB
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
        if(Auth::user()->role_id== 1){
            $item = Support::get();
            return view('admin.support.editsupport',compact('item'));
        }else{
            $item = Support::get();
            return view('admin.support.support',compact('item'));
        }
    }

    public function indexjson()
    {
        return datatables(Support::select('supports.*')
        )->addColumn('action', function ($dt) {
            return view('admin.support.action',compact('dt'));
        })
        ->toJson();
    }

    public function csvall()
    {
        $export = Support::all();
        $filename = 'medin-support.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/medin-support.csv');
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
        return view('admin.support.createupdate',compact('cols'));
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
            'support' => 'required',
        ]);

        $requestData = $request->all();
        Support::create($requestData);
        Session::flash('message', 'Support added'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/support');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        $cols = $this->cols;        
        $item = Support::find($support->id);
        return view('admin.support.createupdate',compact('cols','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $requestData = $request->all();
        Support::find($support->id)->update($requestData);
        Session::flash('message', 'Support updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/support');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        Support::destroy($support->id);
        Session::flash('message', 'Support removed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/support');
    }
}
