<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\Announcement;
use App\User;
use Illuminate\Http\Request;
use Session;
use \Carbon\Carbon;
use Auth;
use App\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.notification.index');
    }
    public function indexjson()
    {
        $query = Notification::orderBy('created_at','DESC');
        return datatables($query->get())
        ->addColumn('action', function ($dt) {
            return view('admin.notification.action',compact('dt'));
        })->toJson();
    }

    public function create()
    {
        return view('admin.notification.createupdate');
    }
    
    public function store(Request $request)
    {
        // $user = User::all();
        $user = User::first();
        // Notification::send($user, new Announcement($request->message));
        // $user->notify(new Announcement($request->message));
        $data['user_id'] = Auth::user()->id;
        $data['type'] = 'announcement';
        $data['data'] = ['title'=>$request->title, 'message'=>$request->message];
        $data['read'] = null;
        // foreach($user as $key=>$val){
            $data['user_to_notify'] = $user->id;
            Notification::create($data);
        // }
        
        Session::flash('message', 'Notification sent to all users'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/notification');
    }

    public function edit($id)
    {
        $item = Notification::find($id);
        return view('admin.notification.createupdate', compact('item'));
    }
    
    public function update(Request $request)
    {
        
    }

    public function markallread(Request $request){
        Notification::where('user_to_notify',Auth::user()->id)->whereNull('read')->update(['read' => now()]);
    }

    public function destroy($id)
    {
        Notification::destroy($id);
        Session::flash('message', 'Notification dihapus'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/notification');
    }

}
