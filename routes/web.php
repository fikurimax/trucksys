<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Truck\TruckController;
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

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::name('vendor.')->prefix('/vendor')->group(function () {
        Route::get('/export-all', [HomeController::class, 'exportAll'])->name('exportAll');
    });

    Route::name('driver.')->prefix('/driver')->group(function () {
        Route::get('/', [DriverController::class, 'index'])->name('index');
        Route::get('/find', [DriverController::class, 'search'])->name('search');
        Route::get('/detail', [DriverController::class, 'detail'])->name('detail');
        Route::get('/export-all', [DriverController::class, 'exportAll'])->name('exportAll');
        Route::get('/registration', [DriverController::class, 'register'])->name('register');
        Route::get('/update', [DriverController::class, 'update'])->name('update');
        Route::post('/save', [DriverController::class, 'save'])->name('save');
        Route::delete('/delete', [DriverController::class, 'delete'])->name('delete');
    });

    Route::name('vehicle.')->prefix('/vehicle')->group(function () {
        Route::get('/', [TruckController::class, 'index'])->name('index');
        Route::get('/detail', [TruckController::class, 'detail'])->name('detail');
        Route::get('/export-all', [TruckController::class, 'exportAll'])->name('exportAll');
        Route::get('/registration', [TruckController::class, 'register'])->name('register');
        Route::get('/update', [TruckController::class, 'update'])->name('update');
        Route::post('/save', [TruckController::class, 'save'])->name('save');
        Route::delete('/delete', [TruckController::class, 'delete'])->name('delete');
    });

    Route::name('account.')->prefix('/account')->group(function () {
        Route::get('/detail', [AccountController::class, 'detail'])->name('detail');
        Route::get('/edit', [AccountController::class, 'edit'])->name('edit');
        Route::post('/save', [AccountController::class, 'save'])->name('save');
    });
});

require __DIR__ . '/auth.php';
