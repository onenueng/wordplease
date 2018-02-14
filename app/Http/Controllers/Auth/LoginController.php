<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    // use AuthenticatesUsers;

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
        if ( filter_var($this->request->input('org_id'), FILTER_VALIDATE_EMAIL) ) {
            // mannual auth
            // return $this->attempLogin();
            $user = $this->attempLogin();
        } else {
            // api auth
            $user = null;
        }

        if ( $user ) {
            auth()->login($user);
            return $this->sendLoginResponse();
        }
        return redirect()->back()->with('error', 'error');
    }

    public function attempLogin()
    {
        $user = \App\User::findByUniqueField('org_id', $this->request->input('org_id'));

        // $db = new \Illuminate\Database\DatabaseManager;
        
        $hash = app('db')->table('users')->select('password')->where('id', $user->id)->first()->password;

        return password_verify( $this->request->input('password'), $hash ) ? $user : null;
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
        return redirect('authenticated');
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
