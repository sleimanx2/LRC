<?php namespace LRC\Services;

use LRC\Data\Users\User;
use Validator;

class Registrar {

    /**
     * @var array
     */
    private $messages = [
        'location.required'  => 'Location not found',
        'latitude.required'  => 'We cant find latitude or logitude',
        'longitude.required' => 'Make sure you select a valid suggested location'
    ];

    /**
     * @var array
     */
    private $rules = [
        'first_name'      => 'required|max:255|min:2',
        'last_name'       => 'required|max:255|min:2',
        'email'           => 'required|max:255|unique:users,email',
        'password'        => 'required|confirmed|min:6',
        'phone_primary'   => 'required|min:8|max:8',
        'phone_secondary' => 'min:8|max:8',
        'location'        => 'required',
        'latitude'        => 'required',
        'longitude'       => 'required'
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @param array $options
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data, array $options = ['withoutPassword' => false, 'userId' => false])
    {
        if ( $options['withoutPassword'] )
        {
            unset($this->rules['password']);
        }

        if ( $options['userId'] )
        {
            $this->rules['email'] = $this->rules['email'] . ',' . $options['userId'];
        }

        return Validator::make($data, $this->rules, $this->messages);
    }


    /**
     * Get a validator for an incoming password change request.
     * @param array $data
     * @return mixed
     */
    public function passwordValidator(array $data)
    {
        $rules['password'] = $this->rules['password'];
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        $data = [
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'email'           => $data['email'],
            'password'        => bcrypt($data['password']),
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ];

        return User::create($data);
    }

    /**
     * @param array $data
     * @param User $user
     * @return bool
     */
    public function update(array $data, User $user)
    {

        $attributes = [
            'first_name'      => $data['first_name'],
            'last_name'       => $data['last_name'],
            'phone_primary'   => $data['phone_primary'],
            'phone_secondary' => $data['phone_secondary'],
            'location'        => $data['location'],
            'latitude'        => $data['latitude'],
            'longitude'       => $data['longitude']
        ];

        if ( $user->email != $data['email'] )
        {
            $attributes['email'] = $data['email'];
        }

        $user->fill($attributes);

        return $user->save();

    }


    /**
     * @param array $data
     * @param User $user
     * @return bool
     */
    public function updatePassword(array $data, User $user)
    {

        $attributes = [
            'password' => bcrypt($data['password']),
        ];

        $user->fill($attributes);

        return $user->save();

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        User::findOrFail($id);
        User::destroy($id);
    }

}
