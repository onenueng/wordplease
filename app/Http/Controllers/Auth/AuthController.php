<?php

namespace App\Http\Controllers\Auth;

use App\User;
// use App\Tempuser;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * use username replace the email
     *
     * @return protected $username = 'username';
     */
    protected $username = 'sap_id';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'sap_id' => 'required|min:8|unique:users',
            // 'username' => 'required|unique:users',
            'name' => 'required|max:100',
            'name_en' => 'required|max:100',
            'gender' => 'required',
            'dob' => 'required|exists:tempusers,dob',
            // 'division_id' => 'required',
            // 'role_id' => 'required',
            // 'licence_no' => 'required_if:role_id,1,2',
            'licence_no' => 'required:max10|unique:users|exists:tempusers,licence_no',
            'email' => 'required|email|max:255|unique:users|exists:tempusers,email',
            'password' => 'required|confirmed|min:6'
        ], [
            'sap_id.required' => 'จำเป็นต้องใส่ SAP ID',
            'sap_id.min' => 'SAP ID ต้องมีความยาว 8 ตัวอักษรขึ้นไป',
            'sap_id.unique' => 'ไม่สามารถใช้ SAP ID นี้ได้ เนื่องจากถูกใช้งานแล้วในระบบ',
            'name.required' => 'จำเป็นต้องใส่ Name (th)',
            'name_en.required' => 'จำเป็นต้องใส่ Name (en)',
            'gender.required' => 'จำเป็นต้องระบุ Gender',
            'dob.required' => 'จำเป็นต้องระบุ Birthdate',
            'dob.exists' => 'Birthdate ไม่ตรงกับข้อมูลที่ท่านแจ้งไว้',
            'licence_no.required' => 'จำเป็นต้องใส่ Register code',
            'licence_no.unique' => 'ไม่สามารถใช้ Register code นี้ได้ เนื่องจากถูกใช้งานแล้วในระบบ',
            'licence_no.exists' => 'Register code ไม่ตรงกับข้อมูลในระบบ',
            'email.required' => 'จำเป็นต้องใส่ E-Mail Address',
            'email.unique' => 'ไม่สามารถใช้ E-Mail Address นี้ได้ เนื่องจากถูกใช้งานแล้วในระบบ',
            'email.exists' => 'E-Mail Address ไม่ตรงกับข้อมูลที่ท่านแจ้งไว้',
            'password.required' => 'จำเป็นต้องใส่ Password',
            'password.confirmed' => 'Password ไม่ตรงกันกับ Confirm Password',
            'password.min' => 'Password ต้องมีความยาว 6 ตัวอักษรขึ้นไป',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // if (!array_key_exists('licence_no',$data))
        //     $data['licence_no'] = '';
        $tempuser = \App\Tempuser::where('email',$data['email'])->first();
        return User::create([
        // $user =  User::create([
            'sap_id' => $data['sap_id'],
            // 'username' => $data['username'],
            'name' => $data['name'],
            'name_en' => $data['name_en'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            // 'division_id' => $data['division_id'],
            'division_id' => $tempuser->division_id,
            'role_id' => $tempuser->role_id,
            // 'role_id' => $data['role_id'],
            // 'licence_no' => (!array_key_exists('licence_no',$data)) ? '':$data['licence_no'],
            'licence_no' => $data['licence_no'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => 1
        ]);

        // return $user;
    }

    

    /**
     * redirect notes
     *
     * @return void
     */
    protected $redirectPath = '/notes';
    // protected $redirectPath = '/auth/login';

    
}
