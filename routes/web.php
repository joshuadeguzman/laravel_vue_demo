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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tasks/edit/{task}', 'HomeController@edit')->name('task.edit');

// TODO: Add additional middlewares here if necessary
Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
    // Tasks
    Route::get('/tasks', 'TaskController@index')->name('tasks.index');
    Route::get('/tasks/{task}', 'TaskController@edit')->name('tasks.edit');
    Route::patch('/tasks/{task}', 'TaskController@update')->name('tasks.update');
    Route::delete('/tasks/{task}', 'TaskController@destroy')->name('tasks.delete');
});

