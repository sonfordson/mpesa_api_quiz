<?php


use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:api')->group(function () {
Route::resource('/register', 'API\RegisterController');

Route::get('/user', 'API\RegisterController@getUsers');

Route::get('/activateSIM/{id}/edit', 'provisionSIMController@get_activateSIM')->name('get_activateSIM');

Route::get('/querySubscriberInfo', 'provisionSIMController@querySubscriberInfo')->name('querySubscriberInfo');
Route::post('/provision_sim', 'provisionSIMController@create_create_sim')->name('create_create_sim');
Route::post('/activateSIM/{id)', 'provisionSIMController@activateSIM')->name('activateSIM');
Route::post('/get_test_activateSIM/{id}', 'provisionSIMController@get_test_activateSIM')->name('get_test_activateSIM');



// });
