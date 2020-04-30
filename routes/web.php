<?php
Auth::routes();
// Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('userlogin','Auth\\LoginController@authenticate')->name('userlogin');
Route::group( ['prefix' => 'admin','middleware' => 'auth' ], function()
{
    Route::get('/', 'Admin\DashboardController@dashboard');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard');
    Route::get('/changepassword', 'Admin\UserController@changepassword');
    Route::post('/editpassword', 'Admin\UserController@editpassword');
    Route::get('/myprofile', 'Admin\UserController@myprofile');
    Route::post('/updateprofile', 'Admin\UserController@updateprofile');
    Route::post('/event/indexjson','Admin\EventController@indexjson');
    Route::get('/event/createwizard','Admin\EventController@createwizard');
    Route::resource('/event','Admin\EventController');
    Route::post('/invitation/indexjson','Admin\InvitationController@indexjson');
    Route::resource('/invitation','Admin\InvitationController');
    Route::post('/notification/indexjson','Admin\NotificationController@indexjson');
    Route::resource('/notification','Admin\NotificationController');
    Route::get('/user/getpartners','Admin\UserController@getpartners');
    Route::post('/user/indexjson','Admin\UserController@indexjson');
    Route::resource('/user', 'Admin\UserController');    
    Route::get('/registerpartner','Admin\UserController@registerpartner');
    Route::get('/partner','Admin\UserController@partnerindex');
    Route::post('/partner/indexjson','Admin\UserController@partnerindexjson');
    Route::get('/administrator','Admin\UserController@administratorindex');
    Route::post('/administrator/indexjson','Admin\UserController@administratorindexjson');
    Route::post('/announcement/indexjson','Admin\AnnouncementController@indexjson');
    Route::resource('/announcement','Admin\AnnouncementController');
    Route::post('/support/indexjson','Admin\SupportController@indexjson');
    Route::resource('/support','Admin\SupportController');
    Route::post('/news/indexjson','Admin\NewsController@indexjson');
    Route::resource('/news','Admin\NewsController');
});