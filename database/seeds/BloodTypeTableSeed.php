<?php
use Illuminate\Database\Seeder;

class BloodTypeTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('blood_types')->delete();

        DB::table('blood_types')->insert(array(
            array('name' => 'A+'),
            array('name' => 'A-'),
            array('name' => 'B+'),
            array('name' => 'B-'),
            array('name' => 'O+'),
            array('name' => 'O-'),
            array('name' => 'AB+'),
            array('name' => 'AB-'),
        ));
    }
}