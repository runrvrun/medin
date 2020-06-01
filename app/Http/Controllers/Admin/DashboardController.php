<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;
use App\Log;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request, $action = null)
    {
        $data = [];
        if(Auth::user()->role_id == 1){
            $data['total_event'] = \App\Event::count();
            $data['total_invitation'] = \App\Invitation::count();
            $data['total_user'] = \App\User::where('role_id','<>',1)->where('status','Active')->count();
            $data['total_partner'] = \App\User::where('role_id','<>',1)->where('partner_status','Active')->where('status','Active')->count();
            $recenttag = ['Event Invite','Event Approved','Event Rejected','Participant Confirm'];
            $data['log'] = \App\Log::leftJoin('users','user_id','users.id')->whereIn('tag',$recenttag)->orderBy('logs.created_at','DESC')->take(10)->get();
            $data['event'] = \App\Event::select('events.*',DB::raw("CONCAT(city,', ',province) AS cityprov"))
            ->join('cities','city_id','cities.id')
            ->join('provinces','province_id','provinces.id')
            ->whereBetween('datetime',[\Carbon\Carbon::now()->subMonth(1),\Carbon\Carbon::now()->addMonth(6)])
            ->where('status','Ongoing')->get();
        }else{
            $data['total_event'] = \App\Event::where('user_id',Auth::user()->id)->count();
            $data['total_invitation'] = \App\Invitation::where('user_id',Auth::user()->id)->count();
            $recenttag = ['Event Invite','Event Approved','Event Rejected','Participant Confirm'];
            $data['log'] = \App\Log::whereIn('tag',$recenttag)->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->take(10)->get();
            $data['event'] = \App\Event::select('events.*',DB::raw("CONCAT(city,', ',province) AS cityprov"))
            ->leftJoin('invitations','event_id','events.id')
            ->join('cities','city_id','cities.id')
            ->join('provinces','province_id','provinces.id')
            ->whereBetween('datetime',[\Carbon\Carbon::now()->subMonth(1),\Carbon\Carbon::now()->addMonth(6)])
            ->where(function($q) {
                $q->where('events.user_id', Auth::user()->id)
                  ->orWhere('invitations.user_id', Auth::user()->id);
                })
            ->where('events.status','Ongoing')->get();
        }
        if($action == 'print'){
            return view('admin.dashboardprint',compact('request','data'));
        }else{
            return view('admin.dashboard',compact('request','data'));
        }
    }   
}
