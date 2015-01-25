<?php namespace LRC\Services;

use LRC\Data\Users\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        $messages = [
            'location.required'  => 'Location not found',
            'latitude.required'  => 'We cant find latitude or logitude',
            'longitude.required' => 'Make sure you select a valid suggested location'
        ];

        return Validator::make($data, [
            'first_name'      => 'required|max:255|min:2',
            'last_name'       => 'required|max:255|min:2',
            'email'           => 'required|email|max:255|unique:users',
            'password'        => 'required|confirmed|min:6',
            'phone_primary'   => 'required|min:8|max:8',
            'phone_secondary' => 'min:8|max:8',
            'location'        => 'required',
            'latitude'        => 'required',
            'longitude'       => 'required'
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'email'           => $data['email'],
            'password'        => bcrypt($data['password']),
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ]);
    }

}
