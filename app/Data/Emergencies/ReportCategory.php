<?php


namespace LRC\Data\Emergencies;

use Illuminate\Database\Eloquent\Model;

class ReportCategory extends Model {

    /**
     * The database table used by the model
     * @var string
     */
    protected $table = 'report_categories';


    /**
     * The attributes that are guarded against mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];


}