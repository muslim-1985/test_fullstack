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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::namespace('Admin')->middleware('auth')->group(function (){
    Route::get('/', 'BookController@index')->name('home');
});
Route::namespace('Admin')->group(function (){
    Route::post('/authorStore', 'AuthorController@storeAuthor')->name('author.store');
    Route::get('/getAuthors', 'AuthorController@getAuthors');
    Route::post('/publishingHouseStore', 'PublishingHouseController@storePublishingHouse')->name('house.store');
    Route::get('/getPublishingHouses', 'PublishingHouseController@getPublishingHouses');
    Route::post('/bookStore', 'BookController@store');
    Route::get('/getBooks', 'BookController@getBooks');
    Route::delete('/destroyBook/{id}', 'BookController@destroyBook');
});
