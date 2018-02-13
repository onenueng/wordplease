<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Return input select choices by field_name.
     * 
     * @param  String  $fieldName
     * @return \Illuminate\Http\Response
     */
    public function authenticated()
    {
        return auth()->user();
    }
}
