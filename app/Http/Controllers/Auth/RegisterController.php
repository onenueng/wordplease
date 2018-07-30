<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Contracts\UserAPI;
use Illuminate\Http\Request;
use App\Traits\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class RegisterController extends Controller
{
    use Authorizable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); // allow guest only
    }

    /**
     * Show the application's register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('vue-app')->with(['title' => 'Register', 'jsFile' => '/js/register.js']);
        // return view('user.register');
    }

    /**
     * Get user data form organization's records
     *
     * @param  Illuminate\Http\Request via DI container
     * @return Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        // check if the ID already exist
        if ( User::findByUniqueField('org_id', $request->org_id) != null ) {
            return [
                'reply_code' => 99, 'reply_text' => 'this ID already taken.',
                'state' => 'error', 'icon' => 'remove',
            ];
        }

        $data = $this->getUserFromAPI($request->org_id);
        
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

    /**
     * Get User data from API with cache implementation
     * @param  integer $id
     * @return array
     */
    protected function getUserFromAPI($id)
    {
        // *** IMPLEMENT ThrottlesLogins ***
        $cacheKey = 'user_org_id@' . $id;

        if ( !Cache::has($cacheKey) ) {
            Cache::put(
                $cacheKey,
                resolve('App\Contracts\UserAPI')->getUser($id),
                config('constant.USER_DATA_FROM_API_CACHE_LIFETIME')
            );
        }
        
        return Cache::get($cacheKey);
    }

    /**
     * Check availability of users table unique fields
     *
     * @param  Illuminate\Http\Request via DI container
     * @return Illuminate\Http\Response
     */
    public function isDataAvailable(Request $request)
    {
        
        $field = ( $request->field == 'username' ) ? 'name' : $request->field;
        $user = User::findByUniqueField($field, $request->value);

        if ( $field != 'org_id' || $user ) {
            if ( $user == null ) {
                return ['state' => 'success', 'reply_text' => 'OK'];
            }
            return ['state' => 'warning', 'reply_text' => 'Sorry this ' . $request->field . ' is already taken.'];
        }

        $user = $this->getUserFromAPI($request->value);

        switch ($user['reply_code']) {
            case 0:
                $user += ['payload' => $user];
                $user['state'] = 'success';
                break;
            case 1:
            case 2:
            case 3:
                $user['state'] = 'warning';
                break;
            default :
                $user['state'] = 'error';
        }

        return $user;
    }

    /**
     * For email registering, they can set the password but can use for a short period.
     * For id registering, they need organization's account for login to the app.
     * All account need an authorization before they can actually use the app.
     * Authorization can perform by pre-made .csv file and by the Admin.
     *
     * @param  Illuminate\Http\Request via DI container
     * @return Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // register every requests
        $newUser = User::insert($request->user);

        // try to load pre-made authorization form .csv file
        if ( $request->mode == 'id' ) {
            $users = (new \App\Services\Dataloader)->loadCSV('id_users');
        } elseif ($request->mode == 'email' ) {
            $users = (new \App\Services\Dataloader)->loadCSV('email_users');;
        } else {
            $users = [];
        }

        // init new user attributes from csv file
        foreach ( $users as $user ) {
            if ( $user['org_id'] == $newUser->org_id ) {
                // division
                $newUser->division()
                        ->associate(\App\Models\Lists\Division::where('name_eng_short', $user['division'])->first())
                        ->save();

                // pln
                if ( $user['pln'] != null ) {
                    $newUser->pln = $user['pln'];
                    $newUser->save();
                }

                // authorize
                $user['user_id'] = $newUser->id;
                $this->grantRoleDefaultPermissions($user);

                // can creat notes
                $this->grantRoleDefaultCanCreateNotes($user);
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
