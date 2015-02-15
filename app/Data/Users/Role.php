<?php namespace LRC\Data\Users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id','created_at','updated_at'];

    /**
     * The relation between users and roles
     */
    public function users()
    {
       return $this->belongsToMany('LRC\Data\Users\User');
    }

}
