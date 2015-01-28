<?php


namespace LRC\Data\Blood;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'blood_requests';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function blood_type()
    {
        return $this->belongsTo('LRC\Data\Blood\BloodType');
    }

    public function blood_bank()
    {
        return $this->belongsTo('LRC\Data\Contacts\Contact','blood_bank_id');
    }

}