<?php
use Illuminate\Database\Seeder;
use LRC\Data\Users\User;
use LRC\Data\Contacts\ContactCategory;
use LRC\Data\Contacts\Contact;
use LRC\Data\Blood\BloodType;
use LRC\Data\Blood\BloodRequest;

use Faker\Factory as Faker;

class BloodRequestTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('blood_requests')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {


            $contactCategories = ContactCategory::lists('id', 'name');

            $hospitalId = $contactCategories['Hospitals'];

            $contacts   = Contact::where('category_id', '=', $hospitalId)->lists('id');
            $users      = User::lists('id');
            $bloodTypes = BloodType::lists('id');


            for ($i = 0; $i < 40; $i ++)
            {
                $randomBloodBankId = array_rand($contacts, 1);
                $randomUserId      = array_rand($users, 1);
                $randomBloodTypeId = array_rand($bloodTypes, 1);

                BloodRequest::create(array(
                    'patient_name'       => $faker->name,
                    'blood_type_id'      => $bloodTypes[$randomBloodTypeId],
                    'quantity'           => $faker->numberBetween(0, 3),
                    'quantity_confirmed' => $faker->numberBetween(0, 3),
                    'case'               => $faker->sentence(1),

                    'contact_name'       => $faker->name,
                    'phone_primary'      => $faker->phoneNumber,
                    'phone_secondary'    => $faker->phoneNumber,

                    'blood_bank_id'      => $contacts[$randomBloodBankId],
                    'urgent_level'       => $faker->numberBetween(0, 5),

                    'due_date'           => $faker->dateTime,
                    'note'               => $faker->realText(),
                    'user_id'            => $users[$randomUserId],

                ));
            }
        }

    }

}