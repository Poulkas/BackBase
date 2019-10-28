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

Route::post('/users', 'UserController@Create')->middleware('auth');
Route::post('/users/{id}', 'UserController@Update')->middleware('auth');
Route::delete('/users/{id}', 'UserController@Delete')->middleware('auth');
Route::get('/users/{id}', 'UserController@GetById')->middleware('auth');
Route::get('/users', 'UserController@GetAll')->middleware('auth');
