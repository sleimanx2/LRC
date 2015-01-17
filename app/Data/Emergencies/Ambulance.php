<?php


namespace LRC\Data\Emergencies;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model{

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'ambulances';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id','created_at','updated_at'];
}