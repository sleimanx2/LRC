<?php

namespace LRC\Providers;

use DB;
use LRC\Data\Blood\BloodType;
use LRC\Data\Contacts\Contact;
use LRC\Data\Users\User;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Global shared variables across all view
        \View::composer('*', function ($view) {
            //Global variables
            $view->with('allBloodTypes', $this->getBloodTypes());
            $view->with('allBloodBanks', $this->getBloodBanksList());
            $view->with('allPatientCases', $this->getPatientCases());
            $view->with('allUsers', $this->getUsersList());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    /**
     * Global Helper Functions
     */
    private function getBloodTypes()
    {
        return array_merge(["" => ""], BloodType::all()->pluck('name', 'id')->toArray());
    }

    private function getBloodBanksList()
    {
        $hospitals = Contact::whereHas('category', function ($q) {
            $q->where('slug', 'hospital');
        })->orderBy('name')->pluck('name', 'id')->toArray();

        $blood_banks = Contact::whereHas('category', function ($q) {
            $q->where('slug', 'blood-bank');
        })->orderBy('name')->pluck('name', 'id')->toArray();

        return array_merge(["" => ""], ["Hospitals" => $hospitals, "Blood Banks" => $blood_banks]);
    }

    private function getPatientCases()
    {
        return ["" => "", 'Cancer' => 'Cancer', 'Anemia' => 'Anemia', 'Operation' => 'Operation', 'Other' => 'Other'];
    }

    private function getUsersList()
    {
        return User::with('roles')->where('is_active', 1)->select(DB::raw("CONCAT(first_name, ' ', last_name) AS name"), 'id')->pluck('name', 'id')->prepend("", "");
    }
}
