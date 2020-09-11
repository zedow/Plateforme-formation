<?php

// Home
Route::get('/', 'HomeController@index');

// Formation
Route::resource('session','DataControllers\c_session');
Route::get('/session/filter','DataControllers\c_session@filter');
Route::get('/session/{session}/devis','DataControllers\c_session@generatePDF');

//Contacter
Route::get('/contacter','c_contact@getData');
Route::post('/contacter','c_contact@postData');

// utilisateurs
Route::auth();
Route::resource('user','DataControllers\c_user');
Route::get('/profile','DataControllers\c_user@profile');
Route::get('/profile/edit','DataControllers\c_user@editProfile');
Route::post('/profile/edit','DataControllers\c_user@updateProfile');


