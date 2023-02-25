<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

Route::get('/', [Controller::class, 'index']);

Route::get('/customer', [Controller::class, 'customer']);
Route::post('/customer', [Controller::class, 'storeCustomer']);
Route::get('/customer/add', [Controller::class, 'addCustomer']);
Route::get('/customer/edit', [Controller::class, 'editCustomer']);
Route::delete('/customer/delete/{id}', [Controller::class, 'destroyCustomer']);
Route::get('/customer/edit/{id}', [Controller::class, 'editCustomer']);
Route::put('/customer/update/{id}', [Controller::class, 'updateCustomer']);

Route::get('/provider', [Controller::class, 'provider']);
Route::post('/provider', [Controller::class, 'storeProvider']);
Route::get('/provider/add', [Controller::class, 'addProvider']);
Route::get('/provider/edit', [Controller::class, 'editProvider']);
Route::delete('/provider/delete/{id}', [Controller::class, 'destroyProvider']);

Route::get('/reports', [Controller::class, 'reports']);
Route::get('/reports-customer', [Controller::class, 'reports_customer']);
Route::get('/reports-provider', [Controller::class, 'reports_provider']);
Route::get('/details/{id}', [Controller::class, 'details']);

Route::get('/', [Controller::class, 'sms']);

Route::delete('/connector/delete/{id}', [Controller::class, 'destroyConnector']);
Route::get('/connector/edit/{id}', [Controller::class, 'editConnector']);
Route::get('/connector', [Controller::class, 'MtConnector']);
Route::get('/connector/add', [Controller::class, 'addConnector']);
Route::post('/connector', [Controller::class, 'storeConnector']);
Route::post('/connector/update/{id}', [Controller::class, 'updateConnector']);


Route::get('/mt-router', [Controller::class, 'Mtrouter']);
Route::post('/mt-router', [Controller::class, 'storeMtrouter']);
Route::get('/mt-router/delete/{id}', [Controller::class, 'destroyMtrouter']);
Route::get('/mt-router/add', [Controller::class, 'addMtrouter']);

Route::get('/rates-provider', [Controller::class, 'ratesProvider']);
Route::post('/rates-provider', [Controller::class, 'storeRatesProvider']);
Route::delete('/rates-provider/delete/{id}', [Controller::class, 'deleteRateProvider']);
Route::get('/rates-provider/add', [Controller::class, 'addRatesProvider']);

Route::get('/rates-customer', [Controller::class, 'ratesCustomer']);
Route::post('/rates-customer', [Controller::class, 'storeRatesCustomer']);
Route::delete('/rates-customer/delete/{id}', [Controller::class, 'deleteRateCustomer']);
Route::get('/rates-customer/add', [Controller::class, 'addRatesCustomer']);


Route::get('/filters', [Controller::class, 'filter']);
Route::post('/filters', [Controller::class, 'storeFilter']);
Route::get('/filters/delete/{id}', [Controller::class, 'destroyFilter']);
Route::get('/filters/add', [Controller::class, 'addFilter']);

Route::get('/dashboard', [Controller::class, 'dashboard']);
Route::get('/dashboardAPI', [Controller::class, 'dashboardAPI']);

Route::get('/logs', [Controller::class, 'logs']);

Route::get('/refil', [Controller::class, 'refill']);
Route::get('/refill/add/{id}', [Controller::class, 'addRefill']);
Route::post('/refil/update/{id}', [Controller::class, 'updateRefill']);

Route::get('/firewall', [Controller::class, 'firewall']);
Route::get('/firewall/add/', [Controller::class, 'addFirewall']);
Route::post('/firewall/add/', [Controller::class, 'storeFirewall']);
Route::delete('/firewall/delete/{id}', [Controller::class, 'deleteFirewall']);
/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
*/
