<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Schema;
use Session;
use Validator;
use App\Event;
use App\Invitation;

class EventController extends Controller
{
    private $cols;

    public function __construct()
    {
        //setup cols
        $dbcols = Schema::getColumnListing('events');//get all columns from DB
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
            if($val == 'city_id'){
                $cols['city'] = ['column'=>'city','dbcolumn'=>'cities.city',
                'caption'=>'City',
                'type' => 'text',
                'B'=>1,'R'=>1,'E'=>0,'A'=>0,'D'=>1
                ];
            }
        } 
        // modify defaults
        $cols['address']['type'] = 'textarea';
        $cols['description']['type'] = 'textarea';
        $cols['status']['type'] = 'enum';
        $cols['status']['enum_values'] = ['New'=>'New','Rejected'=>'Rejected','Ongoing'=>'Ongoing','Canceled'=>'Canceled','Closed'=>'Closed'];
        $cols['city_id']['caption'] = 'City';
        $cols['city_id']['type'] = 'dropdown';
        $cols['city_id']['dropdown_model'] = 'App\City';
        $cols['city_id']['dropdown_value'] = 'id';
        $cols['city_id']['dropdown_caption'] = 'city';
        $cols['city_id']['B'] = 0;
        $cols['user_id']['caption'] = 'User';
        $cols['user_id']['type'] = 'dropdown';
        $cols['user_id']['dropdown_model'] = 'App\User';
        $cols['user_id']['dropdown_value'] = 'id';
        $cols['user_id']['dropdown_caption'] = 'name';
        $cols['user_id']['B'] = 0;

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
        return view('admin.event.index',compact('cols'));
    }

    public function indexjson()
    {
        $query = Event::selectRaw("events.*,city,name, count(invitations.id) as invitation,SUM(CASE 
        WHEN invitations.status='Confirm' THEN 1
        ELSE 0
      END) AS participant")
        ->leftJoin('invitations','event_id','events.id')
        ->leftJoin('users','events.user_id','users.id')
        ->leftJoin('cities','events.city_id','cities.id');

        if(Auth::user()->role_id == 2){
            $query->where('events.user_id',Auth::user()->id);
        }

        return datatables($query->groupBy('events.id')
        )->addColumn('action', function ($dt) {
            return view('admin.event.action',compact('dt'));
        })
        ->toJson();
    }

    public function csvall()
    {
        $export = Event::all();
        $filename = 'medin-event.csv';
        $temp = 'temp/'.$filename;
        (new FastExcel($export))->export('temp/medin-event.csv');
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
        return view('admin.event.createupdate',compact('cols'));
    }
    public function createwizard()
    {
        $cols = $this->cols;        
        $cityprov = \App\City::select(DB::raw("CONCAT(city,', ',province) AS cityprov"),'cities.id')
        ->join('provinces','province_id','provinces.id')->pluck('cityprov','cities.id');
        return view('admin.event.createwizard',compact('cols','cityprov'));
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
            'event' => 'required',
        ]);

        $requestData = $request->all();
        Event::create($requestData);
        Session::flash('message', 'Event added'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/event');
    }

    public function storewizard(Request $request)
    {
        $request->validate([
            'event' => 'required',
        ]);

        $requestData = $request->all();
        $invitation = json_decode($requestData['selected-media-container']);
        $requestData['user_id'] = Auth::user()->id;
        $requestData['status'] = 'New';
        $requestData['datetime'] = Carbon::createFromFormat('l, d M Y g:i A',$request->date.' '.$request->time);
        unset($requestData['date']);
        unset($requestData['time']);
        unset($requestData['selected-media-container']);
        $event = Event::create($requestData);
        // insert invitations
        if(isset($invitation)>0){
            foreach($invitation as $inv){            
                Invitation::create(['event_id'=>$event->id,'user_id'=>$inv,'status'=>'Waiting']);
            }
        }
         
        Session::flash('message', 'Event created'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/event');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $cols = $this->cols;        
        $item = Event::find($event->id);
        return view('admin.event.createupdate',compact('cols','item'));
    }
    public function editwizard($event_id)
    {
        $cols = $this->cols;        
        $item = Event::selectRaw("events.*, CONCAT(city,', ',province) AS cityprov")
        ->join('cities','city_id','cities.id')
        ->join('provinces','province_id','provinces.id')
        ->find($event_id);
        $invites = Invitation::selectRaw("group_concat(user_id) as invites_id")->where('event_id',$event_id)->groupBy('event_id')->first();
        $invitation = Invitation::join('users','user_id','users.id')->where('event_id',$event_id)->get();
        $cityprov = \App\City::select(DB::raw("CONCAT(city,', ',province) AS cityprov"),'cities.id')
        ->join('provinces','province_id','provinces.id')->pluck('cityprov','cities.id');
        return view('admin.event.createwizard',compact('cols','item','invitation','invites','cityprov'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event' => 'required|unique:events,event,'.$event->id,
        ]);

        $requestData = $request->all();
        Event::find($event->id)->update($requestData);
        Session::flash('message', 'Event updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/event');
    }
    public function updatewizard($event_id,Request $request)
    {
        $request->validate([
            'event' => 'required',
        ]);

        $requestData = $request->all();
        $invitation = json_decode($requestData['selected-media-container']);
        $requestData['datetime'] = Carbon::createFromFormat('l, d M Y g:i A',$request->date.' '.$request->time);
        unset($requestData['date']);
        unset($requestData['time']);
        unset($requestData['selected-media-container']);
        Event::find($event_id)->update($requestData);
        // insert invitations
        Invitation::where('event_id',$event_id)->delete(); // reset all invites for this event
        if(isset($invitation)>0){
            foreach($invitation as $inv){            
                Invitation::create(['event_id'=>$event_id,'user_id'=>$inv,'status'=>'Waiting']);
            }
        }
        Session::flash('message', 'Event updated'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/event');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Event::destroy($event->id);
        Session::flash('message', 'Event removed'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/event');
    }

    public function getinvitation(Request $request)
    {
        return Invitation::join('users','user_id','users.id')->where('event_id',$request->eventid)->get();        
    }
    public function getparticipant(Request $request)
    {
        return Invitation::join('users','user_id','users.id')->where('event_id',$request->eventid)->where('invitations.status','Confirm')->get();        
    }
}
