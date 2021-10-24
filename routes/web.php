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

Route::get('/', 'HomeController@mainMenu')->name('landing');

Auth::routes();

Route::get('/home', 'HomeController@mainMenu')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@index')->name('userProfile');
        Route::put('/update/{id}', 'ProfileController@updateProfile')->name('userProfile.Update');
    });
});

///admin route
Route::middleware(['auth', 'UserAdmin'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::post('/manage/user/create', 'ProfileController@createUser')->name('userProfile.createUser');
        Route::get('/manage/user/delete/{id}', 'ProfileController@deleteUser')->name('userProfile.deleteUser');
        Route::get('/manage/user/edit/{id}', 'ProfileController@editUser')->name('userProfile.editUser');
        Route::post('/manage/user/update/{id}', 'ProfileController@updateUser')->name('userProfile.updateUser');
    });

    ///jobcard route
    Route::prefix('jobcard')->group(function () {
        Route::get('/', 'HomeController@index')->name('jobcard.index');
        Route::get('/step-1', 'JobcardController@stepOne')->name('jobcard.stepOneGet');
        Route::post('/step-1-store', 'JobcardController@stepOneStore')->name('jobcard.stepOneStore');

        Route::get('/step-2/{id}', 'JobcardController@stepTwo')->name('jobcard.stepTwoGet');
        Route::post('/step-2-store', 'JobcardController@stepTwoStore')->name('jobcard.stepTwoStore');

        Route::get('/step-3/{id}', 'JobcardController@stepThree')->name('jobcard.stepThreeGet');
        Route::post('/step-3-store/{id}', 'JobcardController@stepThreeStore')->name('jobcard.stepThreeStore');

        Route::get('/detail/{id}', 'JobcardController@jobcardDetail')->name('jobcard.jobcardDetail');
        Route::get('/detail/{id}/close', 'JobcardController@closeTicket')->name('jobcard.closeTicket');
        Route::get('/detail/{id}/cancel', 'JobcardController@cancelTicket')->name('jobcard.cancelTicket');

        Route::post('/countWaitingTime', 'JobcardController@countWaitingTime');
        Route::get('/getClientDataAjax/{id}', 'JobcardController@getClientDataAjax')->name('jobcard.getClientDataAjax');
    });

    ///bp
    Route::prefix('bp')->group(function () {
        Route::get('/', 'BusinessPartnerController@index')->name('bp.index');
        Route::post('/store', 'BusinessPartnerController@store')->name('bp.store');
        Route::get('/edit/{id}', 'BusinessPartnerController@edit')->name('bp.edit');
        Route::post('/update/{id}', 'BusinessPartnerController@update')->name('bp.update');
        Route::get('/delete/{id}', 'BusinessPartnerController@delete')->name('bp.delete');
    });

    ///sp
    Route::prefix('sp')->group(function () {
        Route::get('/', 'ServicePartnerController@index')->name('sp.index');
        Route::post('/store', 'ServicePartnerController@store')->name('sp.store');
        Route::get('/edit/{id}', 'ServicePartnerController@edit')->name('sp.edit');
        Route::post('/update/{id}', 'ServicePartnerController@update')->name('sp.update');
        Route::get('/delete/{id}', 'ServicePartnerController@delete')->name('sp.delete');
    });

    ///sparepart
    Route::prefix('sparepart')->group(function () {
        Route::get('/', 'SparepartController@index')->name('spp.index');
        Route::post('/store', 'SparepartController@store')->name('spp.store');
        Route::get('/edit/{id}', 'SparepartController@edit')->name('spp.edit');
        Route::post('/update/{id}', 'SparepartController@update')->name('spp.update');
        Route::get('/delete/{id}', 'SparepartController@delete')->name('spp.delete');
    });

    ///product
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductDetailController@index')->name('pd.index');
        Route::post('/store', 'ProductDetailController@store')->name('pd.store');
        Route::get('/edit/{id}', 'ProductDetailController@edit')->name('pd.edit');
        Route::post('/update/{id}', 'ProductDetailController@update')->name('pd.update');
        Route::get('/delete/{id}', 'ProductDetailController@delete')->name('pd.delete');
    });

    ///client
    Route::prefix('client')->group(function () {
        Route::get('/', 'ClientController@index')->name('cl.index');
        Route::post('/store', 'ClientController@store')->name('cl.store');
        Route::post('/move', 'ClientController@moveMachine')->name('cl.moveMachine');
        Route::get('/edit/{id}', 'ClientController@edit')->name('cl.edit');
        Route::post('/update/{id}', 'ClientController@update')->name('cl.update');
        Route::get('/delete/{id}', 'ClientController@delete')->name('cl.delete');
        Route::get('/relocate/{id}', 'ClientController@showRelocateClient')->name('cl.relocate');
    });

    ///Customer Service Engineer
    Route::prefix('cse')->group(function () {
        Route::get('/', 'CustomerServiceEngineerController@index')->name('cse.index');
        Route::post('/store', 'CustomerServiceEngineerController@store')->name('cse.store');
        Route::get('/edit/{id}', 'CustomerServiceEngineerController@edit')->name('cse.edit');
        Route::post('/update/{id}', 'CustomerServiceEngineerController@update')->name('cse.update');
        Route::get('/delete/{id}', 'CustomerServiceEngineerController@delete')->name('cse.delete');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/', 'ReportController@index')->name('report.index');
        Route::get('/bp', 'ReportController@bpReport')->name('report.bp');
        Route::post('/bp/filter', 'ReportController@bpReportFilter')->name('report.bpFilter');

        Route::get('/sp', 'ReportController@spReport')->name('report.sp');
        Route::post('/sp/filter', 'ReportController@spReportFilter')->name('report.spFilter');

        Route::get('/pd', 'ReportController@pdReport')->name('report.pd');
        Route::post('/pd/filter', 'ReportController@pdReportFilter')->name('report.pdFilter');

        Route::get('/sps', 'ReportController@spsReport')->name('report.sps');
        Route::post('/sps/filter', 'ReportController@spsReportFilter')->name('report.spsFilter');

        Route::get('/client', 'ReportController@clientReport')->name('report.client');
        Route::post('/client/filter', 'ReportController@clientReportFilter')->name('report.clientFilter');

        Route::get('/cse', 'ReportController@cseReport')->name('report.cse');
        Route::post('/cse/filter', 'ReportController@cseReportFilter')->name('report.cseFilter');
    });
});
