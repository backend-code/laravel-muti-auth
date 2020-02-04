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


Route::get('/verified-only', function(Request $request){

    dd('your are verified', $request->user()->name);
})->middleware('auth:api','verified');

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::post('/reset-link-email', 'API\ForgotPasswordController@sendResetLinkEmail');
Route::post('/reset-password', 'API\ResetPasswordController@reset');


Route::get('/resend-email', 'API\VerificationController@resend')->name('verification.resend');

Route::get('/verify-email/{id}/{hash}', 'API\VerificationController@verify')->name('verification.verify');

Route::apiResource('tasks','API\TasksController')->middleware('auth:api');


// Route::get('/verified-only', function(Request $request){

//     dd('your are verified', $request->user()->name);
// })->middleware('auth:api','verified');


// Route::post('/register', 'API\AuthController@register');
// Route::post('/login', 'API\AuthController@login');

// Route::post('/password/email', 'API\ForgotPasswordController@sendResetLinkEmail');
// Route::post('/password/reset', 'API\ResetPasswordController@reset');


// Route::get('/email/resend', 'API\VerificationController@resend')->name('verification.resend');

// Route::get('/email/verify/{id}/{hash}', 'API\VerificationController@verify')->name('verification.verify');

// Route::apiResource('tasks','API\TasksController')->middleware('auth:api');