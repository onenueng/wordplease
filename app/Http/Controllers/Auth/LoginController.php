<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/authenticated';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // allow guest only except logout
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('vue-app')->with(['title' => 'Login', 'jsFile' => '/js/login.js']);
        // return view('user.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        $user = $this->attemptLogin($request);

        if ( $user ) {
            auth()->login($user);
            return $this->sendLoginResponse();
        }

        // *** IMPLEMENT ThrottlesLogins ***
        return redirect()->back()->with('error', 'credential not matched');
    }

    public function apiLogin(\Illuminate\Http\Request $request)
    {
        $user = $this->attemptLogin($request);

        if ( $user ) {
            return [
                'reply_code' => 0,
            ];
        }

        // *** IMPLEMENT ThrottlesLogins ***
        return [
            'reply_code' => 1,
            'reply_text' => 'Your credential not matched our records or expired.'
        ];
        // return redirect()->back()->with('error', 'credential not matched');
    }

    protected function attemptLogin(\Illuminate\Http\Request $request)
    {
        $user = \App\User::findByUniqueField('org_id', $request->org_id);
        if ( $user == null ) {
            return null;
        }

        if (filter_var($request->org_id, FILTER_VALIDATE_EMAIL)) {
            // auth via app
            if ( $user->expired() ) {
                return null;
            }
            $hash = app('db')->table('users')->select('password')->where('id', $user->id)->first()->password;
            return password_verify($request->password, $hash) ? $user : null;
        } else {
            // auth via api
            $response = app('App\Contracts\UserAPI')->authenticate($request->only(['org_id', 'password']));
            if ( $response['reply_code'] != 0 ) {
                return null;
            }
            return $user;
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse()
    {
        app('request')->session()->regenerate();

        // $this->clearLoginAttempts($request);

        return $this->authenticated($this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated($user)
    {
        $user->seen();
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->guard()->logout();

        app('request')->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard();
    }
}
