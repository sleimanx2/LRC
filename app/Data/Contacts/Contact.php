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


}