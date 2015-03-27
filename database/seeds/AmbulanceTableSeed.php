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

                array('plate_number' => '211', 'brand' => 'BMW', 'year' => 2001),
                array('plate_number' => '224', 'brand' => 'Renault', 'year' => 1999),
                array('plate_number' => '256', 'brand' => 'Nissan', 'year' => 2001),
                array('plate_number' => '284', 'brand' => 'BMW', 'year' => 2001),
                array('plate_number' => '285', 'brand' => 'Renault', 'year' => 1999),
                array('plate_number' => '286', 'brand' => 'Nissan', 'year' => 2001),
                array('plate_number' => '287', 'brand' => 'BMW', 'year' => 2001),
                array('plate_number' => '288', 'brand' => 'Renault', 'year' => 1999),

            ));
        }
    }

}