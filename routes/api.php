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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user', 'AuthorizationController@create_user');
Route::post('sign_in', 'AuthorizationController@authenticate');

Route::middleware(['auth:api'])->group(function () {

  Route::resource('shops', 'ShopController')->only([
    'index'
  ]);
  
  Route::resource('customers', 'CustomerController')->only([
    'index', 'store'
  ]);
  
  Route::get('customers/{phone}', 'CustomerController@find_by_phone');
  
  Route::apiResources([
    'orders' => 'OrderController'
  ]);

});
