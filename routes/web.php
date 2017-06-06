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

Auth::routes();

// Phonebook API Routes
Route::get('/phonebook/get-first-aiders-json', 'PhonebookController@getFirstAidersJSON');
Route::get('/phonebook/get-medical-centers-json', 'PhonebookController@getMedicalCentersJSON');
Route::get('/phonebook/get-lrc-centers-json', 'PhonebookController@getLrcCentersJSON');
Route::get('/phonebook/get-organizations-json', 'PhonebookController@getOrganizationsJSON');
Route::post('/phonebook/dial-number-api', 'PhonebookController@dialNumberAPI');

// OR Dashboard Routes
//Route::group(['middleware' => 'guest'], function () {
Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/or', 'DashboardController@showORDashboard');
Route::get('/dashboard/phonebook', 'DashboardController@showPhonebookDashboard')->name('dashboard-phonebook');
Route::post('/blood/requests/store', 'Blood\BloodRequestsController@store')->name('blood-request-store');
//});

// Authenticated User Routes
Route::group(['middleware' => 'auth'], function () {

    /*
     * DASHBOARD ROUTES
     */
    Route::get('/', 'HomeController@dashboard')->name('home-dashboard');

    /*
     * ADMIN ROUTES
     */
    Route::group(['prefix' => 'admin'], function () {
        // Users
        Route::get('users', 'UsersController@index')->name('users-list');
        Route::get('users/{id}/edit', 'UsersController@edit')->name('user-edit');
        Route::post('users/{id}/update', 'UsersController@update')->name('user-update');//->before('csrf');
        Route::delete('users/{id}/destroy', 'UsersController@destroy')->name('user-destroy');//->before('csrf');
        Route::post('password/{id}/change', 'Auth\PasswordController@postChange')->name('password-change');//->before('csrf');

        // Contacts
        Route::get('contacts', 'ContactsController@index')->name('contacts-list');
        Route::get('contacts/create', 'ContactsController@create')->name('contact-create');
        Route::post('contacts/store', 'ContactsController@store')->name('contact-store');
        Route::get('contacts/{id}/edit', 'ContactsController@edit')->name('contact-edit');
        Route::post('contacts/{id}/update', 'ContactsController@update')->name('contact-update');
        Route::delete('contacts/{id}/destroy', 'ContactsController@destroy')->name('contact-destroy');
    });

    /*
     * BLOOD ROUTES
     */
    Route::group(['prefix' => 'blood', 'namespace' => 'Blood'], function () {
        // Donors
        Route::get('donors', 'BloodDonorsController@index')->name('blood-donors-list');
        Route::get('donors/create', 'BloodDonorsController@create')->name('blood-donor-create');
        Route::post('donors/store', 'BloodDonorsController@store')->name('blood-donor-store');
        Route::get('donors/{id}/edit', 'BloodDonorsController@edit')->name('blood-donor-edit');
        Route::post('donors/{id}/update', 'BloodDonorsController@update')->name('blood-donor-update');
        Route::delete('donors/{id}/destroy', 'BloodDonorsController@destroy')->name('blood-donor-destroy');

        // Requests
        Route::get('requests', 'BloodRequestsController@index')->name('blood-requests-list');
        Route::get('requests/create', 'BloodRequestsController@create')->name('blood-request-create');
        //Route::post('requests/store', 'BloodRequestsController@store')->name('blood-request-store');
        Route::get('requests/{id}/edit', 'BloodRequestsController@edit')->name('blood-request-edit');
        Route::post('requests/{id}/update', 'BloodRequestsController@update')->name('blood-request-update');
        Route::delete('requests/{id}/destroy', 'BloodRequestsController@destroy')->name('blood-request-destroy');
        Route::get('requests/{id}/rescue', 'BloodRequestsController@rescue')->name('blood-request-rescue');
        Route::post('requests/{id}/complete', 'BloodRequestsController@setComplete')->name('blood-request-set-completed');
        Route::post('requests/append-call-log', 'BloodRequestsController@appendCallLog')->name('blood-request-append-call-log');

        // Donations
        Route::post('donation/willDonate', 'BloodDonationsController@willDonate')->name('blood-donor-will-donate');
        Route::post('donation/wontDonate', 'BloodDonationsController@wontDonate')->name('blood-donor-wont-donate');
        Route::post('donation/{id}/confirm', 'BloodDonationsController@confirm')->name('blood-donation-confirmed');
    });


    /*
     * EMERGENCIES ROUTES
    */
    Route::group(['prefix' => 'emergencies', 'namespace' => 'Emergencies'], function () {
        Route::get('/', 'EmergenciesController@index')->name('emergencies-list');
        Route::get('create', 'EmergenciesController@create')->name('emergency-create');
        Route::post('store', 'EmergenciesController@store')->name('emergency-store');
        Route::get('{id}/edit', 'EmergenciesController@edit')->name('emergency-edit');
        Route::post('{id}/update', 'EmergenciesController@update')->name('emergency-update');
        Route::delete('{id}/destroy', 'EmergenciesController@destroy')->name('emergency-destroy');
        Route::post('{id}/status/update', 'EmergenciesController@updateStatus')->name('emergency-status-update');
        Route::get('{id}/manage', 'EmergenciesController@manage')->name('emergency-manage');
        Route::post('{id}/casualties/store', 'CasualtiesController@store')->name('emergency-casualty-store');
        Route::post('casualties/{id}/update', 'CasualtiesController@update')->name('emergency-casualty-update');
    });
});