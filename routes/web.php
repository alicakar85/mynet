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

Route::namespace('Home')->name('home.')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
});

Route::namespace('Web')->name('web.')->group(function () {
    Route::prefix('panel')->name('member.')->group(function () {
        Route::match(['get', 'post'], 'giris', 'DashboardController@login')->name('login');

        Route::middleware(['auth'])->group(function () {
            Route::get('/', 'DashboardController@index')->name('index');
            Route::get('cikis', 'DashboardController@logout')->name('logout');
        });
    });

    Route::middleware(['auth'])->prefix('panel')->group(function () {
        Route::middleware(['can:become.admin'])->group(function () {
            Route::resource('person', 'PersonController');
        });
    });
});
