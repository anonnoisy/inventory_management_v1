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

Route::get('/', 'Auth\LoginController@index');

Auth::routes();

Route::prefix('/dashboard')->namespace('Admin')->name('admin::')->group(function (){
    Route::get('', 'HomeController@index')->name('home');
    Route::prefix('')->group(function (){
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::put('profile/update', 'ProfileController@update')->name('profile-update');
    });

    // Route to User Management
    Route::prefix('/user-manage')->namespace('User')->name('user-manage::')->group(function (){

        // Route user admin management
        Route::name('admin::')->group(function (){
            Route::get('/manage-admin', 'AdminManagementController@index')->name('home');
            Route::get('/manage-admin/create', 'AdminManagementController@create')->name('create');
            Route::post('/manage-admin/store', 'AdminManagementController@store')->name('store');
            Route::get('/manage-admin/{id}/show', 'AdminManagementController@show')->name('show');
            Route::put('/manage-admin/{id}/show/update', 'AdminManagementController@update')->name('update');
            Route::put('/manage-admin/{id}/update/status', 'AdminManagementController@status')->name('status');
            Route::get('/manage-admin/filter-search', 'AdminManagementController@searchByFilter')->name('search-by-filter');
        });

        // Route user head of warehouse management
        Route::name('head-of-warehouse::')->group(function (){
            Route::get('/manage-head-of-warehouse', 'HeadOfWarehouseManagementController@index')->name('home');
            Route::get('/manage-head-of-warehouse/create', 'HeadOfWarehouseManagementController@create')->name('create');
            Route::post('/manage-head-of-warehouse/store', 'HeadOfWarehouseManagementController@store')->name('store');
            Route::get('/manage-head-of-warehouse/{id}/show', 'HeadOfWarehouseManagementController@show')->name('show');
            Route::get('/manage-head-of-warehouse/{id}/update', 'HeadOfWarehouseManagementController@update')->name('update');
            Route::put('/manage-head-of-warehouse/{id}/update/status', 'HeadOfWarehouseManagementController@status')->name('status');
            Route::get('/manage-head-of-warehouse/search', 'HeadOfWarehouseManagementController@searchByFilter')->name('search-by-filter');
        });
    });

    // Route to product management
    Route::prefix('/product-manage')->namespace('Product')->name('product-manage::')->group(function (){

        // Route to brand product management
        Route::name('brand::')->group(function (){
            Route::get('manage-brands', 'BrandManagementController@index')->name('home');
            Route::get('manage-brands/create', 'BrandManagementController@create')->name('create');
            Route::post('manage-brands/store', 'BrandManagementController@store')->name('store');
            Route::get('manage-brands/{id}/show', 'BrandManagementController@show')->name('show');
            Route::put('manage-brands/{id}/update', 'BrandManagementController@update')->name('update');
            Route::put('manage-brands/{id}/update/status', 'BrandManagementController@status')->name('status');
            Route::get('manage-brands/{id}/delete', 'BrandManagementController@destroy')->name('destroy');
            Route::get('manage-brands/search', 'BrandManagementController@searchByFilter')->name('search-by-filter');
        });
    });

});