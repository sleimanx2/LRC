<?php


namespace LRC\Data\Emergencies;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'emergencies';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id','created_at','updated_at'];
}