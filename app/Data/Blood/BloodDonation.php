<?php


namespace LRC\Data\Blood;

use Illuminate\Database\Eloquent\Model;

class BloodDonation extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'blood_donations';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * Belong to relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('LRC\Data\Users\User','user_id');
    }

    /**
     * Belong to relation with donor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donor()
    {
        return $this->belongsTo('LRC\Data\Blood\BloodDonor','donor_id');
    }

}