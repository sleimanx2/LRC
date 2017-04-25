<?php

namespace LRC\Providers;

use LRC\Data\Blood\BloodType;
use LRC\Data\Contacts\Contact;
use Illuminate\Support\ServiceProvider;
use LRC\Data\Users\User;

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
            $view->with('allBloodTypes', $this->getBloodTypes());
            $view->with('allBloodBanks', $this->getBloodBanksList());
            $view->with('users', $this->getAllUsers());
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
     * Helper Functions
     */
    private function getBloodTypes()
    {
        return BloodType::all()->pluck('name', 'id');
    }

    private function getBloodBanksList()
    {
        $list = Contact::whereHas('category', function ($q) {

            $q->where('serves_blood', '=', 1);

        })->orderBy('name')->pluck('name', 'id');

        return $list;
    }

    private function getAllUsers()
    {
        return User::with('roles')->get();
    }
}
