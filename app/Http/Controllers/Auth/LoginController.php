<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Request as RR;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

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

    public function __construct(){
        $this->middleware('lang');
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function admin_login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $notification = array(
            'message' => 'Email-Address And Password Are Wrong.',
            'alert-type' => 'error'
        );

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else {
                //Auth::logout();
                //return redirect()->route('home')->with($notification);;
                $this->guard()->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                if ($response = $this->loggedOut($request)) {
                    return $response;
                }

                $notification = array(
                    'message' => 'هذا الحساب ليس أدمن.',
                    'alert-type' => 'error'
                );

                return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : back()
                    ->with($notification);
            }
        } else {

            return redirect()->route('login.view')
                ->with($notification);
        }
    }

    public function user_login(Request $request){

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $notification = array(
            'message' => Lang::get('content.emailorpassworderror'),
            'alert-type' => 'error'
        );

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {

            if (auth()->user()->is_admin == 0) {
                return redirect()->route('index');
            } else {
                $this->guard()->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                if ($response = $this->loggedOut($request)) {
                    return $response;
                }
                $notification = array(
                    'message' => Lang::get('content.thisuserdoesnothaveanaccount'),
                    'alert-type' => 'error'
                );
                return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : back()
                    ->with($notification);
            }
        } else {

            if (RR::is('admin*')) {
                return redirect()->route('login.view')
                    ->with($notification);
            } else {
                return redirect()->back()->withErrors(['message' => Lang::get('content.emailorpassworderror')]);
            }
        }
    }

    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect('/ar');
    }
}
