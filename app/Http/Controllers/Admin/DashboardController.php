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
            $data['log'] = \App\Log::orderBy('created_at','DESC')->take(10)->get();
        }else{
            $data['total_event'] = \App\Event::where('user_id',Auth::user()->id)->count();
            $data['total_invitation'] = \App\Invitation::where('user_id',Auth::user()->id)->count();
            $data['log'] = \App\Log::orderBy('created_at','DESC')->take(10)->get();
        }
        if($action == 'print'){
            return view('admin.dashboardprint',compact('request','data'));
        }else{
            return view('admin.dashboard',compact('request','data'));
        }
    }   
}
