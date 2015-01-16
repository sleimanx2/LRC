<?php
use Illuminate\Database\Seeder;

class CaseTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('cases')->delete();

        //insert some dummy records
        DB::table('cases')->insert(array(

            array('name'=>'AVP'),
            array('name'=>'Burns'),
            array('name'=>'Unconscious'),
            array('name'=>'Mission'),
            array('name'=>'Misc'),

        ));
    }

}