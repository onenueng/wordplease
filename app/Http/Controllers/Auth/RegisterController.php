<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UserAPI;
use App\Http\Controllers\Controller;
use App\Traits\Authorizable;
use App\Traits\DataImportable;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use DataImportable, Authorizable;

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

    public function getUser(UserAPI $api)
    {
        // check user on table
        // *** IMPLEMENT ThrottlesLogins ***
        $data = $api->getUser(app('request')->org_id);
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

    public function isDataAvailable()
    {
        $request = app('request');

        if ( $request->field == 'username' ) {
            $request->field = 'name';
        }

        $user = \App\User::findByUniqueField($request->field, $request->value);

        if ( $user == null ) {
            return ['reply_text' => 'OK', 'state' => 'success'];
        }

        return ['reply_text' => 'Sorry this ' . $request->field . ' is already taken.', 'state' => 'warning'];
    }

    /*
     * For email registering, they can set the password but can use in a short period.
     * For id registering, they need organization's account for login to the app.
     * All account need an authorization before they can actually use the app.
     * Authorization can perform by pre-made .csv file and by the Admin.
     */
    public function register()
    {
        $request = app('request');

        $newUser = \App\User::insert($request->user); // register all request

        // try to load pre-made authorization form .csv file
        if ( $request->mode == 'id' ) {
            $users = $this->loadCSV('id_users');
        } elseif ($request->mode == 'email' ) {
            $users = $this->loadCSV('email_users');;
        } else {
            $users = [];
        }

        // try to authorize new user
        foreach ( $users as $user ) {
            if ( $user['org_id'] == $newUser->org_id ) {
                if ( $user['pln'] != null ) {
                    $newUser->pln = $user['pln'];
                    $newUser->save();
                }
                $user['user_id'] = $newUser->id;
                $this->grantRoleDefaultPermissions($user);
                break;
            }
        }

        // email register has a password so, log them to the app.
        if ( $request->mode == 'email' ) {
            $newUser->expiry_date = \Carbon\Carbon::now()->addDays(config('constant.EMAIL_ACCOUNT_DEFAULT_LIFETIME'));
            $newUser->seen(); // also saved
            auth()->login($newUser, false);
            return ['href' => 'authenticated'];
        }

        // id register need to authentication with organization's records
        return ['href' => 'login'];
    }
}
