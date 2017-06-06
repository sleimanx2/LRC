<?php
namespace LRC\Data\Contacts;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

class Contact extends Model {

    use FormAccessible;

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'contacts';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id','created_at','updated_at'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['phone_numbers' => 'array'];

    public function category()
    {
        return $this->belongsTo('LRC\Data\Contacts\ContactCategory');
    }

    /**
     * Returns all contacts category
     */
    public function getBloodBanksList()
    {
        $list = $this->whereHas('category', function($q){

            $q->where('serves_blood', 1);

        })->orderBy('name')->pluck('name','id');

        return $list;
    }

    /**
     * Gets the name attribute with sector
     *
     * @return mixed
     */
    public function getNameFmtAttribute()
    {
        return $this->sector . " - " . $this->name;
    }

    /**
     * Gets the contact filter term (combines category slug and favorite flag if true)
     *
     * @return mixed
     */
    public function getFilterTermAttribute()
    {
        if($this->favorite)
            return "favorite-" . $this->category->slug;
        
        return $this->category->slug;
    }

    /**
     * Phone numbers mutator function
     * @return mixed
     */
    public function setPhoneNumbersAttribute($value)
    {
        if($value)
            $this->attributes['phone_numbers'] = '["' . str_replace(',', '","', $value) . '"]';
        else
            $this->attributes['phone_numbers'] = null;
    }

    /**
     * Return the phone numbers attribute for forms
     * @return mixed
     */
    public function formPhoneNumbersAttribute()
    {
        if($this->phone_numbers)
            return implode(",", $this->phone_numbers);

        return "";
    }

    /**
     * Ambulances mutator function
     * @return mixed
     */
    public function setAmbulancesAttribute($value)
    {
        if($value)
            $this->attributes['ambulances'] = '["' . str_replace(',', '","', $value) . '"]';
        else
            $this->attributes['ambulances'] = null;
    }

    /**
     * Return the Ambulances attribute for forms
     * @return mixed
     */
    public function formAmbulancesAttribute()
    {
        if($this->ambulances)
            return implode(",", $this->ambulances);

        return "";
    }
}