<?php namespace LRC\Services;

use LRC\Data\Users\User;
use Validator;

class Registrar
{

    /**
     * @var array
     */
    private $messages = [
        'location.required'  => 'Location not found',
        'latitude.required'  => 'We cant find latitude or longitude',
        'longitude.required' => 'Make sure you select a valid suggested location'
    ];

    /**
     * @var array
     */
    private $rules = [
        'first_name'    => 'required|max:255|min:2',
        'last_name'     => 'required|max:255|min:2',
        'username'      => 'required|max:255|unique:users,email',
        'email'         => 'max:255|unique:users,email',
        'promo'         => 'integer|min:1900',
        'phone_numbers' => 'required',
        'password'      => 'required|confirmed|min:6',
        'location'      => 'required',
        'latitude'      => 'required',
        'longitude'     => 'required'
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
        if ($options['withoutPassword']) {
            unset($this->rules['password']);
        }

        if ($options['userId']) {
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
        $attributes = [
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'username'      => $data['username'],
            'password'      => bcrypt($data['password']),
            'phone_numbers' => $data['phone_numbers'],
            'location'      => $data['location'],
            'latitude'      => $data['latitude'],
            'longitude'     => $data['longitude']
        ];

        if (isset($data['promo'])) {
            $attributes['promo'] = $data['promo'];
        }

        if (isset($data['note'])) {
            $attributes['note'] = $data['note'];
        }

        if (isset($data['email'])) {
            $attributes['email'] = $data['email'];
        }

        $user = User::create($attributes);

        return $this->syncRoles($data, $user);
    }

    /**
     * @param array $data
     * @param User $user
     * @return bool
     */
    public function update(array $data, User $user)
    {

        $attributes = [
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'username'      => $data['username'],
            'phone_numbers' => $data['phone_numbers'],
            'location'      => $data['location'],
            'latitude'      => $data['latitude'],
            'longitude'     => $data['longitude']
        ];

        if (isset($data['promo'])) {
            $attributes['promo'] = $data['promo'];
        }

        if (isset($data['note'])) {
            $attributes['note'] = $data['note'];
        }

        if (isset($data['email'])) {
            $attributes['email'] = $data['email'];
        }

        $user->fill($attributes);

        $this->syncRoles($data, $user);

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

    /**
     * @param array $data
     * @param User $user
     */
    public function syncRoles(array $data, User $user)
    {
        if (!isset($data['roles_ids'])) {
            $data['roles_ids'] = [];
        }

        $user->roles()->sync($data['roles_ids']);
    }


}
