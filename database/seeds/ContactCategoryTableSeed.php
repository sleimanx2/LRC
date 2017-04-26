<?php
use Illuminate\Database\Seeder;
use LRC\Data\Contacts\ContactCategory;

class ContactCategoryTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('contact_categories')->delete();

        // ------ V1 ---------------------------------------------------------------------------------
        // ContactCategory::create(['name' => 'Hospitals', 'serves_blood' => true,'is_hospital'=>true]);
        // ContactCategory::create(['name' => 'Blood Banks', 'serves_blood' => true,'is_hospital'=>false]);
        // ContactCategory::create(['name' => 'Insurances', 'serves_blood' => false,'is_hospital'=>false]);
        // ContactCategory::create(['name' => 'Radio Stations', 'serves_blood' => false,'is_hospital'=>false]);
        // ContactCategory::create(['name' => 'DC', 'serves_blood' => false,'is_hospital'=>false]);
        // ContactCategory::create(['name' => 'Fire Fighters', 'serves_blood' => false,'is_hospital'=>false]);
        // ContactCategory::create(['name' => 'Services', 'serves_blood' => false,'is_hospital'=>false]);
        // ContactCategory::create(['name' => 'Misc', 'serves_blood' => false,'is_hospital'=>false]);

        // ------ V2 ---------------------------------------------------------------------------------
        // ---------------------- MEDICAL CENTERS
        ContactCategory::create(['name' => 'Hospital', 'slug' => 'hospital', 'serves_blood' => true, 'is_hospital' => true, 'parent_category' => 'medical-centers' ]);
        ContactCategory::create(['name' => 'Nursing Home', 'slug' => 'nursing-home', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'medical-centers' ]);
        ContactCategory::create(['name' => 'Blood Bank', 'slug' => 'blood-bank', 'serves_blood' => true, 'is_hospital' => false, 'parent_category' => 'medical-centers' ]);

        // ---------------------- LRC CENTERS
        ContactCategory::create(['name' => 'LRC Center', 'slug' => 'lrc-center', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'lrc-centers' ]);

        // ---------------------- ORGANIZATIONS
        ContactCategory::create(['name' => 'Civil Defense', 'slug' => 'civil-defense', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Fire Department', 'slug' => 'fire-department', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'ISF Police', 'slug' => 'isf-police', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Airport', 'slug' => 'airport', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Ports', 'slug' => 'ports', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Radio & Television', 'slug' => 'radio-television', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Journals', 'slug' => 'journals', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => '204 Doctors', 'slug' => '204-doctors', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Medical Centers', 'slug' => 'medical-centers', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Insurance Companies', 'slug' => 'insurance-companies', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Restaurants', 'slug' => 'restaurants', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
        ContactCategory::create(['name' => 'Other Contacts', 'slug' => 'other-contacts', 'serves_blood' => false, 'is_hospital' => false, 'parent_category' => 'organizations' ]);
    }

}