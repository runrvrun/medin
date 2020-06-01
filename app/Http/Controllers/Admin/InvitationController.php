<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Html;
use Schema;
use Session;
use Validator;
use App\Event;
use App\Log;
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
                $cols['organizer'] = ['column'=>'organizer','dbcolumn'=>'a.name',
                'caption'=>'Organizer',
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>0,'A'=>0,'D'=>1
                ];
                $cols['name'] = ['column'=>'name','dbcolumn'=>'users.name',
                'caption'=>'Partner',
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>0,'A'=>0,'D'=>1
                ];
            }
            if($val == 'event_id'){
                $cols['event'] = ['column'=>'event','dbcolumn'=>'events.event',
                'caption'=>'Event',
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
            $cols['user_id']['B'] = 0;
            $cols['user_id']['E'] = 0;
            $cols['user_id']['A'] = 0;
            $cols['event_id']['B'] = 0;
            $cols['event_id']['E'] = 0;
            $cols['event_id']['A'] = 0;
        } 
        // modify defaults        
        $cols['status']['type'] = 'enum';
        $cols['status']['enum_values'] = ['Waiting'=>'Waiting','Confirm'=>'Confirm','Unavailable'=>'Unavailable'];        
        $this->cols = $cols;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->partner_status !== 'Active' && Auth::user()->role_id !== 1){
            return view('admin.invitation.notallowed');            
        }
        $cols = $this->cols;        
        return view('admin.invitation.index',compact('cols'));
    }

    public function indexjson()
    {
        $query = Invitation::select('invitations.*','users.name','a.name as organizer', 'event')
        ->leftJoin('events','event_id','events.id')
        ->leftJoin('users','invitations.user_id','users.id')
        ->leftJoin('users as a','events.user_id','a.id');
        if(Auth::user()->role_id!= 1){
            $query->where('invitations.user_id',Auth::user()->id);
        }
        return datatables($query)->addColumn('action', function ($dt) {
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
            // 'invitation' => 'required|unique:invitations,invitation,'.$invitation->id,
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

    public function accept($invitation_id)
    {
        $invitation = Invitation::where('user_id',Auth::user()->id)->where('id',$invitation_id)->first();
        $invitation->update(['status'=>'Confirm']);
        $numofconfirm = Invitation::where('event_id',$invitation->event_id)->where('status','Confirm')->count();
        $numofconfirm = $numofconfirm-1;
        $event = Event::find($invitation->event_id);
        if($numofconfirm>0){
            Log::create(['user_id'=>$event->user_id,'tag'=>'Participant Confirm','detail'=>Auth::user()->name.' and '.$numofconfirm.' other people confirmed to your event '.Html::link('admin/event',$event->event).'.']);
        }else{
            Log::create(['user_id'=>$event->user_id,'tag'=>'Participant Confirm','detail'=>Auth::user()->name.' confirmed to your event '.Html::link('admin/event',$event->event).'.']);
        }
        Session::flash('message', 'Invitation confirmed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/invitation');
    }
    public function reject($invitation_id)
    {
        $invitation = Invitation::where('user_id',Auth::user()->id)->where('id',$invitation_id)->first();
        $invitation->update(['status'=>'Unavailable']);
        Session::flash('message', 'Invitation rejected'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/invitation');
    }
}
