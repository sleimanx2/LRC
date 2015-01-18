<?php
use Illuminate\Database\Seeder;

class AmbulanceTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('ambulances')->delete();

        // Insert some dummy records

        if ( app()->environment() == 'local' )
        {
            DB::table('ambulances')->insert(array(

                array('plate_number' => '224', 'brand' => 'BMW', 'year' => 2001),
                array('plate_number' => '225', 'brand' => 'Renault', 'year' => 1999),
                array('plate_number' => '226', 'brand' => 'Nissan', 'year' => 2001),
            ));
        }
    }

}