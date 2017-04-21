<?php
use Illuminate\Database\Seeder;
use LRC\Data\Contacts\ContactCategory;
use LRC\Data\Contacts\Contact;
use Faker\Factory as Faker;

class ContactTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('contacts')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {
            // List contacts categories
            $categories = ContactCategory::pluck('id');


            for ($i = 0; $i < 50; $i ++)
            {

                $randKey = array_rand($categories->toArray(), 1);

                Contact::create(array(
                    'name'            => $faker->company . rand(0, 100),
                    'phone_primary'   => $faker->phoneNumber,
                    'phone_secondary' => $faker->phoneNumber,
                    'location'        => $faker->address,
                    'latitude'        => $faker->latitude,
                    'longitude'       => $faker->longitude,
                    'category_id'     => $categories[$randKey],
                ));
            }
        }

    }

}