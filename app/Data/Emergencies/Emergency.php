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

    /**
     * Get the driver
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo('LRC\Data\Users\User','driver_id');
    }

    /**
     * Get the scout
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scout()
    {
        return $this->belongsTo('LRC\Data\Users\User','scout_id');
    }

    /**
     * Get the patient aider
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient_aider()
    {
        return $this->belongsTo('LRC\Data\Users\User','patient_aider_id');
    }

    /**
     * Get the assistant
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assistant()
    {
        return $this->belongsTo('LRC\Data\Users\User','assistant_id');
    }

    /**
     * Get the assistant
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ambulance()
    {
        return $this->belongsTo('LRC\Data\Emergencies\Ambulance','ambulance_id');
    }

    /**
     * Get the emergency casualties
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function casualties()
    {
        return $this->hasMany('LRC\Data\Emergencies\Casualty');
    }

    /**
     * Get the casualties count
     * @return mixed
     */
    public function casualties_count()
    {
        return $this->hasMany('LRC\Data\Emergencies\Casualty')->count();
    }

    public function report_category()
    {
        return $this->belongsTo('LRC\Data\Emergencies\ReportCategory');
    }





}