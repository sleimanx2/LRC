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

		$this->call('CaseTableSeeder');
        $this->call('AmbulancesTableSeeder');

        $this->call('EmergencyTableSeeder');

        $this->call('ContactCategoriesTableSeeder');
        $this->call('ContactsTableSeeder');

        $this->call('BloodTypesTableSeeder');

	}

}
