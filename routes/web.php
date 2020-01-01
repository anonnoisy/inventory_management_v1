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

Route::prefix('/dashboard')->namespace('Admin')->name('admin::')->group(function (){
    Route::get('', 'HomeController@index')->name('home');
    Route::prefix('')->group(function (){
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::put('profile/update', 'ProfileController@update')->name('profile-update');
    });

    // route to User Management
    Route::prefix('')->namespace('User')->name('user-manage::')->group(function (){

        // Route user admin management
        Route::name('admin::')->group(function (){
            Route::get('/manage-admin', 'AdminManagementController@index')->name('home');
            Route::get('/manage-admin/create', 'AdminManagementController@create')->name('create');
            Route::post('/manage-admin/store', 'AdminManagementController@store')->name('store');
            Route::get('/manage-admin/{id}/show', 'AdminManagementController@show')->name('show');
            Route::put('/manage-admin/{id}/update-status', 'AdminManagementController@status')->name('status');
            Route::get('/manage-admin/filter-search', 'AdminManagementController@searchByFilter')->name('search-by-filter');
        });

        // Route user head of warehouse management
        Route::name('head-of-warehouse::')->group(function (){
            Route::get('/manage-head-of-warehouse', 'HeadOfWarehouseManagementController@index')->name('home');
            Route::get('/manage-head-of-warehouse/create', 'HeadOfWarehouseManagementController@create')->name('create');
            Route::post('/manage-head-of-warehouse/store', 'HeadOfWarehouseManagementController@store')->name('store');
            Route::get('/manage-head-of-warehouse/{id}/show', 'HeadOfWarehouseManagementController@show')->name('show');
            Route::put('/manage-head-of-warehouse/{id}/update-status', 'HeadOfWarehouseManagementController@status')->name('status');
            Route::get('/manage-head-of-warehouse/filter-search', 'HeadOfWarehouseManagementController@searchByFilter')->name('search-by-filter');
        });
    });
});