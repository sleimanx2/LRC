<?php


namespace LRC\Data\Blood;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'blood_types';

    public function blood_donors_count()
    {
        return $this->hasMany('LRC\Data\Blood\BloodDonor')->count();
    }

}
