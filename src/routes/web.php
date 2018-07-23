<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function ()
{
    Route::any('/', function ()
    {
        // Uses Auth Middleware
    });
});

Route::group(['namespace' => '\biopartnering\biopartnering\Http\Controllers', 'middleware' => 'web'], function()
{
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('/login', ['uses' => 'Auth\LoginController@login']);
    Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('/register', ['uses' => 'Auth\RegisterController@register']);

    Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);

    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['uses' => 'Auth\ResetPasswordController@reset']);

    Route::get('/user/verify/{token}', ['uses' => 'Auth\LoginController@verifyUser']);

    Route::get('/dashboard', ['uses' => 'DashboardController@dashboard']);

    Route::group(['prefix' => 'user'], function()
    {
        Route::get('/account', ['uses' => 'User\UserController@account']);
        Route::get('/settings', ['uses' => 'User\UserController@settings']);
        Route::get('/notifications/{id?}', ['uses' => 'User\MessagesController@notifications']);
        Route::get('/messages/{id?}', ['uses' => 'User\MessagesController@messages']);
        Route::get('/meetings', ['uses' => 'User\MeetingsController@meetings']);
        Route::get('/calender', ['uses' => 'User\MeetingsController@calender']);
        Route::match(['get', 'post'], '/meeting/add', ['uses' => 'User\MeetingsController@add_meeting']);
        Route::match(['get', 'put'], '/meeting/edit/{id}', ['uses' => 'User\MeetingsController@edit_meeting']);

        //AJAX routes
        Route::group(['prefix' => 'ajax'], function()
        {
            Route::post('/save_account_details', ['uses' => 'User\UserController@save_account_details']);
            Route::put('/change_password', ['uses' => 'User\UserController@change_password']);
            Route::put('/change_email', ['uses' => 'User\UserController@change_email']);
            Route::put('/update_availability', ['uses' => 'User\UserController@update_availability']);
            Route::delete('/remove_availability/{id}', ['uses' => 'User\UserController@remove_availability']);
            Route::post('/add_availability', ['uses' => 'User\UserController@add_availability']);
            Route::get('/get_message_content/{section}', ['uses' => 'User\MessagesController@get_message_content']);
            Route::post('/send_message', ['uses' => 'User\MessagesController@send_message']);
            Route::get('/get_message_history/{id}', ['uses' => 'User\MessagesController@get_message_history']);
        });
    });
});