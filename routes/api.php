<?php

use Illuminate\Http\Request;

//route clients
Route::get('clients/', 'UsersController@index');//get all users

//route payments
Route::get('payment/', 'UsersController@getPayment');//get all payments of a user specified
Route::get('payments/', 'PaymentsController@index');//get all payments
Route::post('payment/', 'PaymentsController@create');//create a new payment
Route::delete('payment/', 'PaymentsController@delete');//destroy a payment with uuid provided
