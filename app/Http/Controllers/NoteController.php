<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return input select choices by field_name.
     *
     * @param  String  $fieldName
     * @return \Illuminate\Http\Response
     */
    public function index(\Illuminate\Contracts\Auth\Access\Gate $gate)
    {
        if ( $gate->allows('create-note') ) {
            return 'notes';
        }
        return redirect('not-allowed');
    }

    public function audit()
    {
        return 'audit';
    }
}
