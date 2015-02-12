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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function ()
{
    // Users

    Route::get('users', ['as' => 'users-list', 'uses' => 'UsersController@index']);

    Route::get('users/edit/{id}', ['as' => 'user-edit', 'uses' => 'UsersController@edit']);

    Route::post('users/update/{id}', ['before' => 'csrf', 'as' => 'user-update', 'uses' => 'UsersController@update']);

    Route::delete('users/destroy/{id}', ['before' => 'csrf', 'as' => 'user-destroy', 'uses' => 'UsersController@destroy']);

    Route::post('password/change/{id}', ['before' => 'csrf', 'as' => 'password-change', 'uses' => 'PasswordController@postChange']);

// Contacts

    Route::get('contacts', ['as' => 'contacts-list', 'uses' => 'ContactsController@index']);

    Route::get('contacts/create', ['as' => 'contact-create', 'uses' => 'ContactsController@create']);

    Route::post('contacts/store', ['as' => 'contact-store', 'uses' => 'ContactsController@store']);

    Route::get('contacts/edit/{id}', ['as' => 'contact-edit', 'uses' => 'ContactsController@edit']);

    Route::post('contacts/update/{id}', ['as' => 'contact-update', 'uses' => 'ContactsController@update']);

    Route::delete('contacts/destroy/{id}', ['as' => 'contact-destroy', 'uses' => 'ContactsController@destroy']);

    /*
     * BLOOD
    */
    Route::group(['prefix' => 'blood', 'namespace' => 'Blood'], function ()
    {
        // Donors

        Route::get('donors', ['as' => 'blood-donors-list', 'uses' => 'BloodDonorsController@index']);

        Route::get('donors/create', ['as' => 'blood-donor-create', 'uses' => 'BloodDonorsController@create']);

        Route::post('donors/store', ['as' => 'blood-donor-store', 'uses' => 'BloodDonorsController@store']);

        Route::get('donors/edit/{id}', ['as' => 'blood-donor-edit', 'uses' => 'BloodDonorsController@edit']);

        Route::post('donors/update/{id}', ['as' => 'blood-donor-update', 'uses' => 'BloodDonorsController@update']);

        Route::delete('donors/destroy/{id}', ['as' => 'blood-donor-destroy', 'uses' => 'BloodDonorsController@destroy']);

        Route::post('donors/willDonate', ['as' => 'blood-donor-will-donate', 'uses' => 'BloodDonorsController@willDonate']);

        Route::post('donors/wontDonate', ['as' => 'blood-donor-wont-donate', 'uses' => 'BloodDonorsController@wontDonate']);


        // Blood Requests

        Route::get('requests', ['as' => 'blood-requests-list', 'uses' => 'BloodRequestsController@index']);

        Route::get('requests/create', ['as' => 'blood-request-create', 'uses' => 'BloodRequestsController@create']);

        Route::post('requests/store', ['as' => 'blood-request-store', 'uses' => 'BloodRequestsController@store']);

        Route::get('requests/edit/{id}', ['as' => 'blood-request-edit', 'uses' => 'BloodRequestsController@edit']);

        Route::post('requests/update/{id}', ['as' => 'blood-request-update', 'uses' => 'BloodRequestsController@update']);

        Route::delete('requests/destroy/{id}', ['as' => 'blood-request-destroy', 'uses' => 'BloodRequestsController@destroy']);

        Route::get('requests/rescue/{id}', ['as' => 'blood-request-rescue', 'uses' => 'BloodRequestsController@rescue']);

    });

});




