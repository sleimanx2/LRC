<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication Routes...
Route::group(['namespace' => 'Auth','prefix'=>'auth'], function ()
{
  Route::get('login', 'AuthController@showLoginForm');
  Route::post('login', 'AuthController@login');
  Route::get('logout', 'AuthController@logout');

  // Registration Routes...
  //
  Route::group(['middleware' => 'auth'], function ()
  {
    Route::get('register', 'AuthController@showRegistrationForm');
    Route::post('register', 'AuthController@register');

  });
  
  // Password Change Routes...
  // Password Reset Routes...
  Route::get('password/reset/{token?}', 'PasswordController@showResetForm');
  Route::post('password/email', 'PasswordController@sendResetLinkEmail');
  Route::post('password/reset', 'PasswordController@reset');

});



Route::group(['middleware' => 'auth'], function ()
{

    Route::get('/', ['as' => 'home-dashboard', 'uses' => 'HomeController@dashboard']);
    Route::get('/home', ['uses' => 'HomeController@dashboard']);

    // Users
    Route::get('users', ['as' => 'users-list', 'uses' => 'UsersController@index']);

    Route::get('users/{id}/edit', ['as' => 'user-edit', 'uses' => 'UsersController@edit']);

    Route::post('users/{id}/update', ['before' => 'csrf', 'as' => 'user-update', 'uses' => 'UsersController@update']);

    Route::delete('users/{id}/destroy', ['before' => 'csrf', 'as' => 'user-destroy', 'uses' => 'UsersController@destroy']);

    Route::post('password/{id}/change', ['before' => 'csrf', 'as' => 'password-change', 'uses' => 'Auth\PasswordController@postChange']);

    // Contacts

    Route::get('contacts', ['as' => 'contacts-list', 'uses' => 'ContactsController@index']);

    Route::get('contacts/create', ['as' => 'contact-create', 'uses' => 'ContactsController@create']);

    Route::post('contacts/store', ['as' => 'contact-store', 'uses' => 'ContactsController@store']);

    Route::get('contacts/{id}/edit', ['as' => 'contact-edit', 'uses' => 'ContactsController@edit']);

    Route::post('contacts/{id}/update', ['as' => 'contact-update', 'uses' => 'ContactsController@update']);

    Route::delete('contacts/{id}/destroy', ['as' => 'contact-destroy', 'uses' => 'ContactsController@destroy']);

    /*
     * BLOOD
    */
    Route::group(['prefix' => 'blood', 'namespace' => 'Blood'], function ()
    {
        // Donors

        Route::get('donors', ['as' => 'blood-donors-list', 'uses' => 'BloodDonorsController@index']);

        Route::get('donors/create', ['as' => 'blood-donor-create', 'uses' => 'BloodDonorsController@create']);

        Route::post('donors/store', ['as' => 'blood-donor-store', 'uses' => 'BloodDonorsController@store']);

        Route::get('donors/{id}/edit', ['as' => 'blood-donor-edit', 'uses' => 'BloodDonorsController@edit']);

        Route::post('donors/{id}/update', ['as' => 'blood-donor-update', 'uses' => 'BloodDonorsController@update']);

        Route::delete('donors/{id}/destroy', ['as' => 'blood-donor-destroy', 'uses' => 'BloodDonorsController@destroy']);


        // Blood Requests

        Route::get('requests', ['as' => 'blood-requests-list', 'uses' => 'BloodRequestsController@index']);

        Route::get('requests/create', ['as' => 'blood-request-create', 'uses' => 'BloodRequestsController@create']);

        Route::post('requests/store', ['as' => 'blood-request-store', 'uses' => 'BloodRequestsController@store']);

        Route::get('requests/{id}/edit', ['as' => 'blood-request-edit', 'uses' => 'BloodRequestsController@edit']);

        Route::post('requests/{id}/update', ['as' => 'blood-request-update', 'uses' => 'BloodRequestsController@update']);

        Route::delete('requests/{id}/destroy', ['as' => 'blood-request-destroy', 'uses' => 'BloodRequestsController@destroy']);

        Route::get('requests/{id}/rescue', ['as' => 'blood-request-rescue', 'uses' => 'BloodRequestsController@rescue']);

        Route::post('requests/{id}/complete', ['as' => 'blood-request-set-completed', 'uses' => 'BloodRequestsController@setComplete']);


        // Blood Donations

        Route::post('donation/willDonate', ['as' => 'blood-donor-will-donate', 'uses' => 'BloodDonationsController@willDonate']);

        Route::post('donation/wontDonate', ['as' => 'blood-donor-wont-donate', 'uses' => 'BloodDonationsController@wontDonate']);

        Route::post('donation/{id}/confirm', ['as' => 'blood-donation-confirmed', 'uses' => 'BloodDonationsController@confirm']);

    });


    /*
     * EMERGENCIES
    */
    Route::group(['prefix' => 'emergencies', 'namespace' => 'Emergencies'], function ()
    {
        Route::get('/', ['as' => 'emergencies-list', 'uses' => 'EmergenciesController@index']);

        Route::get('create', ['as' => 'emergency-create', 'uses' => 'EmergenciesController@create']);

        Route::post('store', ['as' => 'emergency-store', 'uses' => 'EmergenciesController@store']);

        Route::get('{id}/edit', ['as' => 'emergency-edit', 'uses' => 'EmergenciesController@edit']);

        Route::post('{id}/update', ['as' => 'emergency-update', 'uses' => 'EmergenciesController@update']);

        Route::delete('{id}/destroy', ['as' => 'emergency-destroy', 'uses' => 'EmergenciesController@destroy']);

        Route::post('{id}/status/update', ['as' => 'emergency-status-update', 'uses' => 'EmergenciesController@updateStatus']);

        Route::get('{id}/manage', ['as' => 'emergency-manage', 'uses' => 'EmergenciesController@manage']);

        Route::post('{id}/casualties/store', ['as' => 'emergency-casualty-store', 'uses' => 'CasualtiesController@store']);

        Route::post('casualties/{id}/update', ['as' => 'emergency-casualty-update', 'uses' => 'CasualtiesController@update']);

    });

});
