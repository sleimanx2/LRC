<?php


namespace LRC\Data\Blood;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodDonor extends Model {

	use SoftDeletes;

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
	
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function blood_type()
    {
        return $this->belongsTo('LRC\Data\Blood\BloodType');
    }

    /**
     * Return the donor's phone number(s)
     *
     * @return mixed
     */
    public function getPhoneNumbersAttribute()
    {
        $phone_numbers = $this->phone_primary;
        
        if($this->phone_secondary)
            $phone_numbers .= ", " . $this->phone_secondary;

        return $phone_numbers;
    }

}