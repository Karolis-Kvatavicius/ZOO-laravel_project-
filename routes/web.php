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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/species', 'SpeciesController@index')->name('animalSpecies');
Route::post('/species', 'SpeciesController@store')->name('animalSpecies');
Route::get('/species/destroy/{species}', 'SpeciesController@destroy')->name('deleteSpecies');

Route::get('/managers', 'ManagerController@index')->name('managers');
Route::post('/managers', 'ManagerController@store')->name('managers');
Route::get('/managerDelete/{id}', 'ManagerController@destroy')->name('deleteManager');
Route::get('/managerEdit/{id}', 'ManagerController@edit')->name('editManager');
Route::post('/managerUpdate/{id}', 'ManagerController@update')->name('updateManager');

Route::get('/animals', 'AnimalController@index')->name('animals');
Route::post('/animals', 'AnimalController@store')->name('animals');
Route::get('/animalDelete/{id}', 'AnimalController@destroy')->name('deleteAnimal');
Route::get('/animalEdit/{id}', 'AnimalController@edit')->name('editAnimal');
Route::post('/animalUpdate/{id}', 'AnimalController@update')->name('updateAnimal');

Route::post('/getmsg/{species_id}','AnimalController@ajax');
