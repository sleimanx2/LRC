<?php
use Illuminate\Database\Seeder;

class AmbulancesTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('ambulances')->delete();

        // Insert some dummy records

        if ( app()->environment() == 'local' )
        {
            DB::table('ambulances')->insert(array(

                array('plateNumber' => '224','brand'=>'BMW','year'=>2001),
                array('plateNumber' => '225','brand'=>'Renault','year'=>1999),
                array('plateNumber' => '226','brand'=>'Nissan','year'=>2001),
            ));
        }
    }

}