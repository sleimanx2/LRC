<?php
use Illuminate\Database\Seeder;
use LRC\Data\Blood\BloodDonor;
use LRC\Data\Blood\BloodRequest;
use LRC\Data\Users\User;
use LRC\Data\Blood\BloodDonationRequest;

use Faker\Factory as Faker;

class BloodDonationRequestTableSeeder extends Seeder {

    public function run()
    {
        // Delete Table
        DB::table('blood_donation_requests')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {
            $users         = User::lists('id');
            $bloodRequests = BloodRequest::lists('id');
            $donors        = BloodDonor::lists('id');


            for ($i = 0; $i < 200; $i ++)
            {
                $randomUserId         = array_rand($users, 1);
                $randomBloodRequestId = array_rand($bloodRequests, 1);
                $randomDonorsId       = array_rand($donors, 1);


                BloodDonationRequest::create(array(

                    'user_id'          => $users[$randomUserId],
                    'donor_id'         => $donors[$randomDonorsId],
                    'blood_request_id' => $bloodRequests[$randomBloodRequestId],


                    'confirmed'        => $faker->boolean(),
                    'declined'         => $faker->boolean(),

                    'note'             => $faker->realText(),

                ));
            }
        }

    }

}