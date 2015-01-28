<?php
use Illuminate\Database\Seeder;
use LRC\Data\Contacts\ContactCategory;

class ContactCategoryTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('contact_categories')->delete();

        ContactCategory::create(['name' => 'Hospitals', 'serves_blood' => true]);
        ContactCategory::create(['name' => 'Blood Banks', 'serves_blood' => true]);
        ContactCategory::create(['name' => 'Insurances', 'serves_blood' => false]);
        ContactCategory::create(['name' => 'Radio Stations', 'serves_blood' => false]);
        ContactCategory::create(['name' => 'DC', 'serves_blood' => false]);
        ContactCategory::create(['name' => 'Fire Fighters', 'serves_blood' => false]);
        ContactCategory::create(['name' => 'Services', 'serves_blood' => false]);
        ContactCategory::create(['name' => 'Misc', 'serves_blood' => false]);
    }

}