<?php


namespace LRC\Data\Blood;

use Illuminate\Database\Eloquent\Model;

class BloodDonor extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'blood_donors';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'created_at', 'updated_at'];

}