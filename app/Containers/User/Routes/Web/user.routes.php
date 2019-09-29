<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/user', 'UserController@Create')->middleware('auth');
Route::post('/user/{id}', 'UserController@Update')->middleware('auth');
Route::delete('/user/{id}', 'UserController@Delete')->middleware('auth');
Route::get('/user/{id}', 'UserController@GetById')->middleware('auth');
Route::get('/user', 'UserController@GetAll')->middleware('auth');
