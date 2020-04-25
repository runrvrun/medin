<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Demorequest;
use Session;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function demorequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['status'] = 'new';
        
        Demorequest::create($requestData);
        // return response('Success',200);
        Session::flash('message', 'Thank you for requesting our demo. Our team will contact you soon.'); 
        return redirect( url('/#newsletter') );
    }
}
