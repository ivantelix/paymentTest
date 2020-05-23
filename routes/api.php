<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//route clients
Route::get('clients/', 'UsersController@index');

//route payments
Route::get('payment/', 'UsersController@getPayment');
Route::get('payments/', 'PaymentsController@index');
Route::post('payment/create', 'PaymentsController@create');
Route::delete('payment/', 'PaymentsController@delete');