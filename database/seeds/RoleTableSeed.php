
<?php
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('roles')->delete();

        // Insert some dummy records
        DB::table('roles')->insert(array(
            array('name' => 'Regional Manager'),
            array('name' => 'Conseil Member'),
            array('name' => 'Ambulance Driver'),
            array('name' => 'Team Manager'),
            array('name' => 'Senior First Aider'),
            array('name' => 'Junior First Aider'),
        ));
    }

}