<?php

namespace LRC\Data\Blood;

use Illuminate\Database\Eloquent\Model;

class BloodRequestCallLog extends Model
{
    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'blood_request_call_logs';


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
     * Belong to relation with blood request
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blood_request()
    {
        return $this->belongsTo('LRC\Data\Blood\BloodRequest','blood_request_id');
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
