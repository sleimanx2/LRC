
<?php
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('roles')->delete();

        // Insert some dummy records
        DB::table('roles')->insert(array(
            ['name' => 'Regional Manager','id'=>1],
            ['name' => 'Conseil Member','id'=>2],
            ['name' => 'Ambulance Driver','id'=>3],
            ['name' => 'Team Manager','id'=>4],
            ['name' => 'Senior First Aider','id'=>5],
            ['name' => 'Junior First Aider','id'=>6],
            ['name' => 'Ex Member','id'=>7],
            ['name' => 'Ami Du Centre','id'=>8]
        ));
    }

}