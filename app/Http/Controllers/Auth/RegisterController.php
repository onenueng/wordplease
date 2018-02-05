<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\UserAPI;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function getUser($orgId, UserAPI $api)
    {
        // check users table first
        // return $request->all() + ['reply_code' => 100, 'reply_text' => 'test'];
        // $api = new App\APIs\Siriraj\UserProvider;
        // $data = $api->getUser($request->input('org_id'));
        return $api->getUser($orgId);
        switch ($data['reply_code']) {
            case 0:
                $data['state'] = 'success';
                $data['icon'] = 'ok';
                break;
            case 1:
            case 2:
            case 3:
                $data['state'] = 'warning';
                $data['icon'] = 'warning-sign';
                break;
            default :
                $data['state'] = 'error';
                $data['icon'] = 'remove';
        }
        return $data;
    }

    public function isDataAvailable(Request $request)
    {

        $user = User::where($request->input('field'), $request->input('value'))->first();

        if ( $user == null ) {
            return ['reply_text' => 'OK', 'state' => 'success'];
        }

        return ['reply_text' => 'Sorry this ' . $request->input('field') . ' is already taken.', 'state' => 'warning'];
    }
}
