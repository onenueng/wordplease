<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserAPI;
use Illuminate\Http\Request;
use App\Traits\DataImportable;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    use DataImportable;

    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->request = app('request');
    }

    public function showRegisterForm()
    {
        return view('user.register');
    }

    public function getUser(Request $request, UserAPI $api)
    {
        // check user in list
        // check user on table
        $data = $api->getUser($request->input('org_id'));
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
        return ['reply_text' => 'OK', 'state' => 'success'];
        $user = User::where($request->input('field'), $request->input('value'))->first();

        if ( $user == null ) {
            return ['reply_text' => 'OK', 'state' => 'success'];
        }

        return ['reply_text' => 'Sorry this ' . $request->input('field') . ' is already taken.', 'state' => 'warning'];
    }

    public function register()
    {
        $newUser = \App\User::insert($this->request->input('user'));
        
        if ( $this->request->input('mode') == 'id' ) {
            $users = $this->loadCSV('id_users');
        } else {
            $users = [];
        }

        

        foreach ( $users as $user ) {
            if ( $user['org_id'] == $newUser->org_id ) {
                if ( $user['pln'] != null ) {
                    $newUser->pln = $user['pln'];
                    $newUser->save();
                }

                if ( $user['division_id'] != null && $user['role_id'] != null ) {
                    $auth = \App\Authorize::insert([
                        'role_id' => $user['role_id'],
                        'division_id' => $user['division_id'],
                    ]);
                    $newUser->authorizes()->attach($auth);
                }

                if ( $this->request->input('mode') == 'email' ) {
                    auth()->login($newUser);
                    return ['href' => '/authenticated'];                    
                }
            }
        }
        return ['href' => 'login'];
    }
}
