<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Lang;
use App\Log;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function authenticate(Request $request)
    {        
        Session::flush();// flush existing session
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();            
            // check active
            if ($user->status !== 'Active') { 
                Auth::logout();
                return redirect('login')->withErrors([
                    'email' => 'User inactive',
                ]);
            }
            // get role privileges
            $priv = \App\Role_privilege::where('role_id',Auth::user()->role_id)->get();
            foreach($priv as $key=>$pri){
                $privilege[$pri->page_id] = ['browse'=>$pri->browse,'add'=>$pri->add,'edit'=>$pri->edit,'delete'=>$pri->delete];
            }
            session(['privilege'=>$privilege]);
            //
            Log::create(['user_id'=>Auth::user()->id,'tag'=>'Login','detail'=>'Success']);

            return redirect()->intended('/admin');
        }else{
            Log::create(['user_id'=>0,'tag'=>'Login','detail'=>'Failed. email: '.$request->email.'; IP: '.$request->ip()]);
            return redirect('login')->withErrors([
                'email' => Lang::get('auth.failed'),
            ]);;
        }
    }

    protected function loggedOut(Request $request) {
        return redirect('/login');
    }
}
