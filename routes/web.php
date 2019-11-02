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


Route::middleware(['auth'])->group(function () {
    Route::get('/form_entry', 'NirbachonController@create')->name('formentry');
    Route::get('/form_search', 'NirbachonController@search')->name('formsearch');

});
// for ajax call

Route::get('/upojila', 'ApiDataController@upojila')->name('forUpojila');
Route::get('/pourosova/{id?}', 'ApiDataController@pourosova')->name('forPourosova');
Route::get('/village/{id?}', 'ApiDataController@village')->name('forVillage');
Route::get('/votkendro/{id?}', 'ApiDataController@votkendro')->name('forVotkendro');
Route::post('/saveVoter', 'ApiDataController@saveVoter')->name('saveVoter');
Route::post('/getSearchResult', 'ApiDataController@getSearchResult')->name('searchResult');
