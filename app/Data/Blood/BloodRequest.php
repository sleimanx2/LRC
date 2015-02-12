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


    /**
     * Belong to relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('LRC\Data\Users\User','user_id');
    }

    /**
     * Belong to relation with blood type
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blood_type()
    {
        return $this->belongsTo('LRC\Data\Blood\BloodType');
    }

    /**
     * Belong to relation with blood banks / contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blood_bank()
    {
        return $this->belongsTo('LRC\Data\Contacts\Contact', 'blood_bank_id');
    }

    /**
     * Has many relation with blood donations
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blood_donations()
    {
        return $this->hasMany('LRC\Data\Blood\BloodDonation','blood_request_id')->with(['user','donor']);
    }

    /**
     * Get the number of platelets donation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function platelets_donations_count()
    {
        return $this->hasMany('LRC\Data\Blood\BloodDonation','blood_request_id')->where('platelets',1)->count();
    }

    /**
     * Get the number of platelets donation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blood_donations_count()
    {
        return $this->hasMany('LRC\Data\Blood\BloodDonation','blood_request_id')->where('blood',1)->count();
    }

}