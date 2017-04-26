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

            $contactCategories = ContactCategory::pluck('id', 'name');

            $hospitalId = $contactCategories['Hospital'];

            $contacts   = Contact::where('category_id', '=', $hospitalId)->pluck('id');
            $users      = User::pluck('id');
            $bloodTypes = BloodType::pluck('id');

            $genders = ['male', 'female'];

            for ($i = 0; $i < 40; $i ++)
            {
                $randomBloodBankId = array_rand($contacts->toArray(), 1);
                $randomUserId      = array_rand($users->toArray(), 1);
                $randomBloodTypeId = array_rand($bloodTypes->toArray(), 1);

                $platelets_quantity  = $faker->numberBetween(0, 5);
                $platelets_confirmed = rand(0, $platelets_quantity);

                $blood_quantity  = $faker->numberBetween(0, 5);
                $blood_confirmed = rand(0, $blood_quantity);
                $completed       = 0;

                if ( $blood_quantity == $blood_confirmed and $platelets_quantity == $platelets_confirmed )
                {
                    $completed = 1;
                }

                $genderKey = array_rand($genders);
                $genderValue = $genders[$genderKey];

                BloodRequest::create(array(
                    'patient_name'                 => $faker->name,
                    'blood_type_id'                => $bloodTypes[$randomBloodTypeId],
                    'blood_quantity'               => $blood_quantity,
                    'blood_quantity_confirmed'     => $blood_confirmed,
                    'platelets_quantity'           => $platelets_quantity,
                    'platelets_quantity_confirmed' => $platelets_confirmed,
                    'completed'                    => $completed,
                    'case'                         => $faker->sentence(1),
                    'patient_gender'               => $genderValue,
                    'contact_name'                 => $faker->name,
                    'phone_primary'                => $faker->phoneNumber,
                    'phone_secondary'              => $faker->phoneNumber,

                    'blood_bank_id'                => $contacts[$randomBloodBankId],
                    'urgent_level'                 => $faker->numberBetween(0, 5),

                    'due_date'                     => date('Y-m-d', strtotime('+' . rand(0, 3) . 'days')),
                    'note'                         => $faker->realText(),
                    'user_id'                      => $users[$randomUserId],

                ));
            }
        }

    }

}