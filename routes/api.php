<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['json.response']], function () {
  Route::get('/contact/sync', 'App\Http\Controllers\ContactController@sync');
  Route::get('/contact', 'App\Http\Controllers\ContactController@index');
  Route::get('/contact/{id}', 'App\Http\Controllers\ContactController@read');
  Route::post('/contact', 'App\Http\Controllers\ContactController@store');
  Route::patch('/contact/{id}', 'App\Http\Controllers\ContactController@update');
  Route::delete('/contact/{id}', 'App\Http\Controllers\ContactController@delete');
});
