<?php


namespace LRC\Data\Contacts;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {


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
        $list = $this->whereHas('category',function($q){

            $q->where('serves_blood','=',1);

        })->orderBy('name')->pluck('name','id');

        return $list;
    }

}