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

// Donors

Route::get('donors', ['as' => 'blood-donors-list', 'uses' => 'BloodDonorsController@index']);

Route::get('donors/create', ['as' => 'blood-donor-create', 'uses' => 'BloodDonorsController@create']);

Route::post('donors/store', ['as' => 'blood-donor-store', 'uses' => 'BloodDonorsController@store']);

Route::get('donors/edit/{id}', ['as' => 'blood-donor-edit', 'uses' => 'BloodDonorsController@edit']);

Route::post('donors/update/{id}', ['as' => 'blood-donor-update', 'uses' => 'BloodDonorsController@update']);

Route::delete('donors/destroy/{id}', ['as' => 'blood-donor-destroy', 'uses' => 'BloodDonorsController@destroy']);


