<?php


namespace LRC\Data\Contacts;

use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model {


    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'contact_categories';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

}
