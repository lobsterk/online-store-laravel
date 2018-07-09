<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserAddress;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'patronymic'    => 'string|max:255',
            'phone'         => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = (new  User)->create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => isset($data['patronymic']) ? $data['patronymic'] : '',
            'phone' => $data['phone'],
            'email' => $data['email'],
            'status' => User::STATUS_ACTIVE,
            'role'  => User::ROLE_CLIENT,
            'last_login' => date('Y-m-d H:i:s'),
            'password' => Hash::make($data['password']),
        ]);

        if (isset($data['addr'])) {
            Validator::make($data['addr'], [
                'city'          => 'required|string|max:255',
                'region'       => 'required|string|max:255',
                'address1'       => 'required|string|max:255',
                'postcode'       => 'required|integer|max:255',
            ]);

            $addr = (new UserAddress)->create([
                'user_id' => $user->id,
                'city' => $data['addr']['city'],
                'region' => $data['addr']['region'],
                'address1' => $data['addr']['address1'],
                'postcode' => $data['addr']['postcode'],
                'status' => UserAddress::STATUS_ACTIVE
            ]);

        }

        return $user;
    }
}
