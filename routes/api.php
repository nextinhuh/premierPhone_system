<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'cli'], function () {
    Route::get('/list/{id}', 'Api\ClienteController@listById');
    Route::get('/list/equip/{id}', 'Api\ClienteController@listEquipById');
    Route::get('/equip/{id}', 'Api\ClienteController@equipById');
});

Route::group(['prefix' => 'pes'], function () {
    Route::get('/search/{id}', 'Api\PessoaController@searcgById');
   /* Route::get('/list/equip/{id}', 'Api\ClienteController@listEquipById');
    Route::get('/equip/{id}', 'Api\ClienteController@equipById');*/
});