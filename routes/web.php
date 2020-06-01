<?php
Auth::routes(['verify' => true]);
// Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('userlogin','Auth\\LoginController@authenticate')->name('userlogin');
Route::get('/news/{a}', 'HomeController@singlenews');
Route::group( ['prefix' => 'admin','middleware' => 'verified' ], function()
{
    Route::get('/', 'Admin\DashboardController@dashboard');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard');
    Route::get('/changepassword', 'Admin\UserController@changepassword');
    Route::post('/editpassword', 'Admin\UserController@editpassword');
    Route::get('/myprofile', 'Admin\UserController@myprofile');
    Route::post('/updateprofile', 'Admin\UserController@updateprofile');
    Route::get('/stoppartner', 'Admin\UserController@stoppartner');
    Route::get('/deactivate', 'Admin\UserController@deactivate');
    Route::post('/event/indexjson','Admin\EventController@indexjson');
    Route::get('/event/createwizard','Admin\EventController@createwizard');
    Route::post('/event/storewizard','Admin\EventController@storewizard');
    Route::get('/event/{a}/editwizard','Admin\EventController@editwizard');
    Route::patch('/event/{a}/updatewizard','Admin\EventController@updatewizard');
    Route::get('/event/{a}/approve','Admin\EventController@approve');
    Route::get('/event/{a}/reject','Admin\EventController@reject');
    Route::get('/event/{a}/cancel','Admin\EventController@cancel');
    Route::get('/event/getinvitation','Admin\EventController@getinvitation');
    Route::get('/event/getparticipant','Admin\EventController@getparticipant');
    Route::resource('/event','Admin\EventController');
    Route::post('/invitation/indexjson','Admin\InvitationController@indexjson');
    Route::get('/invitation/{a}/accept','Admin\InvitationController@accept');
    Route::get('/invitation/{a}/reject','Admin\InvitationController@reject');
    Route::resource('/invitation','Admin\InvitationController');
    Route::get('/user/getpartners','Admin\UserController@getpartners');
    Route::get('/user/partner','Admin\UserController@indexpartner');
    Route::post('/user/indexpartnerjson','Admin\UserController@indexpartnerjson');
    Route::get('/user/{a}/changepassword','Admin\UserController@changeuserpassword');
    Route::get('/user/partner/review/{a}','Admin\UserController@partnerreview');
    Route::post('/user/indexjson','Admin\UserController@indexjson');
    Route::resource('/user', 'Admin\UserController');    
    Route::post('/admin/indexjson','Admin\AdminController@indexjson');
    Route::resource('/admin', 'Admin\AdminController');    
    Route::get('/registerpartner','Admin\UserController@registerpartner');
    Route::post('/announcement/indexjson','Admin\AnnouncementController@indexjson');
    Route::resource('/announcement','Admin\AnnouncementController');
    Route::post('/support/indexjson','Admin\SupportController@indexjson');
    Route::resource('/support','Admin\SupportController');
    Route::post('/news/indexjson','Admin\NewsController@indexjson');
    Route::resource('/news','Admin\NewsController');
});