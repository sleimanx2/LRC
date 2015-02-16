<?php
use Illuminate\Database\Seeder;

class ReportCategoryTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('report_categories')->delete();

        // Insert some dummy records
        DB::table('report_categories')->insert(array(

            array('name' => 'AVP'),
            array('name' => 'Burns'),
            array('name' => 'Unconscious'),
            array('name' => 'Mission'),
            array('name' => 'Misc'),

        ));
    }

}