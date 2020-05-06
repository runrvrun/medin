<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Schema;
use Session;
use Validator;
use App\Announcement;

class AnnouncementController extends Controller
{
    private $cols;

    public function __construct()
    {
        //setup cols
        $dbcols = Schema::getColumnListing('announcements');//get all columns from DB
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
        if(Auth::user()->role == 1){
            return view('admin.announcement.index',compact('cols'));
        }else{
            $item = Announcement::take(10)->orderBy('created_at','DESC')->get();
            return view('admin.announcement.announcement',compact('item'));
        }
    }

    public function indexjson()
    {
        return datatables(Announcement::select('announcements.*')
        )->addColumn('action', function ($dt) {
            return view('admin.announcement.action',compact('dt'));
        })
        ->toJson();
    }

    public function csvall()
    {
        $export = Announcement::all();
        $filename = 'medin-announcement.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/medin-announcement.csv');
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
        return view('admin.announcement.createupdate',compact('cols'));
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
            'announcement' => 'required',
        ]);

        $requestData = $request->all();
        Announcement::create($requestData);
        Session::flash('message', 'Announcement added'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/announcement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        $cols = $this->cols;        
        $item = Announcement::find($announcement->id);
        return view('admin.announcement.createupdate',compact('cols','item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'announcement' => 'required|unique:announcements,announcement,'.$announcement->id,
        ]);

        $requestData = $request->all();
        Announcement::find($announcement->id)->update($requestData);
        Session::flash('message', 'Announcement updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/announcement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        Announcement::destroy($announcement->id);
        Session::flash('message', 'Announcement removed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/announcement');
    }
}
