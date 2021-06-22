<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('landing');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


///admin route
Route::middleware(['auth', 'Admin'])->group(function () {
    ///jobcard route
    Route::prefix('jobcard')->group(function () {
        Route::get('/step-1', 'JobcardController@stepOne')->name('jobcard.stepOneGet');
        Route::post('/step-1-store', 'JobcardController@stepOneStore')->name('jobcard.stepOneStore');

        Route::get('/step-2/{id}', 'JobcardController@stepTwo')->name('jobcard.stepTwoGet');
        Route::post('/step-2-store', 'JobcardController@stepTwoStore')->name('jobcard.stepTwoStore');

        Route::get('/step-3/{id}', 'JobcardController@stepThree')->name('jobcard.stepThreeGet');
        Route::post('/step-3-store/{id}', 'JobcardController@stepThreeStore')->name('jobcard.stepThreeStore');

        Route::get('/detail/{id}', 'JobcardController@jobcardDetail')->name('jobcard.jobcardDetail');
        Route::get('/detail/{id}/close', 'JobcardController@closeTicket')->name('jobcard.closeTicket');

        Route::post('/countWaitingTime', 'JobcardController@countWaitingTime');
    });

    Route::prefix('bp')->group(function () {
        Route::get('/', 'BusinessPartnerController@index')->name('bp.index');
        Route::post('/store', 'BusinessPartnerController@store')->name('bp.store');
        Route::get('/edit/{id}', 'BusinessPartnerController@edit')->name('bp.edit');
        Route::post('/update/{id}', 'BusinessPartnerController@update')->name('bp.update');
        Route::get('/delete/{id}', 'BusinessPartnerController@delete')->name('bp.delete');
    });

    Route::prefix('sp')->group(function () {
        Route::get('/', 'ServicePartnerController@index')->name('sp.index');
        Route::post('/store', 'ServicePartnerController@store')->name('sp.store');
        Route::get('/edit/{id}', 'ServicePartnerController@edit')->name('sp.edit');
        Route::post('/update/{id}', 'ServicePartnerController@update')->name('sp.update');
        Route::get('/delete/{id}', 'ServicePartnerController@delete')->name('sp.delete');
    });

    Route::prefix('sparepart')->group(function () {
        Route::get('/', 'SparepartController@index')->name('spp.index');
        Route::post('/store', 'SparepartController@store')->name('spp.store');
        Route::get('/edit/{id}', 'SparepartController@edit')->name('spp.edit');
        Route::post('/update/{id}', 'SparepartController@update')->name('spp.update');
        Route::get('/delete/{id}', 'SparepartController@delete')->name('spp.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductDetailController@index')->name('pd.index');
        Route::post('/store', 'ProductDetailController@store')->name('pd.store');
        Route::get('/edit/{id}', 'ProductDetailController@edit')->name('pd.edit');
        Route::post('/update/{id}', 'ProductDetailController@update')->name('pd.update');
        Route::get('/delete/{id}', 'ProductDetailController@delete')->name('pd.delete');
    });

    Route::prefix('client')->group(function () {
        Route::get('/', 'ClientController@index')->name('cl.index');
        Route::post('/store', 'ClientController@store')->name('cl.store');
        Route::get('/edit/{id}', 'ClientController@edit')->name('cl.edit');
        Route::post('/update/{id}', 'ClientController@update')->name('cl.update');
        Route::get('/delete/{id}', 'ClientController@delete')->name('cl.delete');
    });
});
