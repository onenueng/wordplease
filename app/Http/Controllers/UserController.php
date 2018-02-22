<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function authenticated()
    {
        return redirect(auth()->user()->dashboard);
    }

    public function profile()
    {
        return 'profile';
    }
}
