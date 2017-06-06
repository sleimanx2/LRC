<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $this->call('UserTableSeeder');
        $this->call('RoleTableSeeder');
        $this->call('RoleUserTableSeeder');

        $this->call('ReportCategoryTableSeeder');
        $this->call('AmbulanceTableSeeder');

        $this->call('EmergencyTableSeeder');

        $this->call('ContactCategoryTableSeeder');
        $this->call('ContactTableSeeder');

        $this->call('BloodTypeTableSeeder');
        $this->call('BloodDonorTableSeeder');
        $this->call('BloodRequestTableSeeder');
        $this->call('BloodDonationRequestTableSeeder');

    }

}
