<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->request = app('request');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login()
    {
        $user = $this->attemptLogin();
        if ( $user ) {
            auth()->login($user);
            return $this->sendLoginResponse();
        }

        // *** IMPLEMENT ThrottlesLogins ***
        return redirect()->back()->with('error', 'credential not matched');
    }

    protected function attemptLogin()
    {
        $user = \App\User::findByUniqueField('org_id', $this->request->org_id);
        if ( $user == null ) {
            return null;
        }

        if (filter_var($this->request->org_id, FILTER_VALIDATE_EMAIL)) {
            // auth via app
            $hash = app('db')->table('users')->select('password')->where('id', $user->id)->first()->password;
            return password_verify($this->request->password, $hash) ? $user : null;
        } else {
            // auth via api
            $response = app('App\Contracts\UserAPI')->authenticate($this->request->only(['org_id', 'password']));
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
        $this->request->session()->regenerate();

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
        // return redirect('authenticated');
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

        $this->request->session()->invalidate();

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
