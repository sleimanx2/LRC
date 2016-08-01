<?php namespace LRC\Data\Users;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'remember_token', 'created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * The relation between users and roles
     */
    public function roles()
    {
        return $this->belongsToMany('LRC\Data\Users\Role');
    }

    /**
     * Return the roles list that belongs to a certain user
     * @return mixed
     */
    public function getRolesIdsAttribute()
    {
        return $this->roles()->lists('id')->toArray();
    }

    /**
     * Return the full name attribute
     * @return mixed
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

}
