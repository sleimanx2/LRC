<?php
use Illuminate\Database\Seeder;

class ContactCategoriesTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('contact_categories')->delete();

        // Insert some dummy records
        DB::table('contact_categories')->insert(array(

            array('name'=>'Hospitals'),
            array('name'=>'Blood Banks'),
            array('name'=>'Insurances'),
            array('name'=>'Radio Stations'),
            array('name'=>'DC'),
            array('name'=>'Fire Fighters'),
            array('name'=>'Services'),
            array('name'=>'Misc'),

        ));
    }

}