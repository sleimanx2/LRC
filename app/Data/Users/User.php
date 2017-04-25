<?php namespace LRC\Data\Users;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable, SoftDeletes;

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['phone_numbers' => 'array'];

    /**
     * The relation between users and roles
     */
    public function roles()
    {
        return $this->belongsToMany('LRC\Data\Users\Role');
    }

    /**
     * Return the roles list that belongs to a certain user
     *
     * @return mixed
     */
    public function getRolesIdsAttribute()
    {
        return $this->roles()->pluck('id')->toArray();
    }

    /**
     * Check if the user is regional manager
     *
     * @return mixed
     */
    public function getIsRmAttribute()
    {
        return $this->roles->contains('id', 1) ? 1 : 0;
    }

    /**
     * Check if the user is an ex member
     *
     * @return mixed
     */
    public function getIsExAttribute()
    {
        return $this->roles->contains('id', 7) ? 1 : 0;
    }

    /**
     * Check if the user is an ex member
     *
     * @return mixed
     */
    public function getIsAmiAttribute()
    {
        return $this->roles->contains('id', 8) ? 1 : 0;
    }

    /**
     * Return the full name attribute
     * @return mixed
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
