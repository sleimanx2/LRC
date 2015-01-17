<?php


namespace LRC\Data\Emergencies;

use Illuminate\Database\Eloquent\Model;

class EmergencyCase extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'cases';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];


}