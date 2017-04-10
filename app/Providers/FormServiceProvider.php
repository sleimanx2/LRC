<?php

namespace LRC\Providers;

use LRC\Data\Blood\BloodType;
use LRC\Data\Contacts\Contact;
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
        view()->share('allBloodTypes', $this->getBloodTypes());
        view()->share('allBloodBanks', $this->getBloodBanksList());
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
     * Helper Functions
     */
    private function getBloodTypes() {
        return BloodType::all()->pluck('name', 'id');
    }

    private function getBloodBanksList() {
        $list = Contact::whereHas('category',function($q) {

            $q->where('serves_blood', '=', 1);

        })->orderBy('name')->pluck('name','id');

        return $list;
    }
}
