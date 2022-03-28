<?php

use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Truck\TruckController;
use App\Http\Controllers\Vendor\VendorController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::name('driver.')->prefix('/driver')->group(function () {
        Route::get('/', [DriverController::class, 'index'])->name('index');
        Route::get('/find', [DriverController::class, 'search'])->name('search');
        Route::get('/register', [DriverController::class, 'register'])->name('register');
        Route::get('/update', [DriverController::class, 'update'])->name('update');
        Route::post('/save', [DriverController::class, 'save'])->name('save');
        Route::delete('/delete', [DriverController::class, 'delete'])->name('delete');
    });

    Route::name('vendor.')->prefix('/vendor')->group(function () {
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::get('/register', [VendorController::class, 'register'])->name('register');
        Route::get('/update', [VendorController::class, 'update'])->name('update');
        Route::post('/save', [VendorController::class, 'save'])->name('save');
        Route::delete('/delete', [VendorController::class, 'delete'])->name('delete');

        Route::name('truck.')
            ->middleware('truck.require.vendor_id')
            ->prefix('/truck')
            ->group(function () {
                Route::get('/', [TruckController::class, 'index'])->name('index');
                Route::get('/register', [TruckController::class, 'register'])->name('register');
                Route::get('/update', [TruckController::class, 'update'])->name('update');
                Route::post('/save', [TruckController::class, 'save'])->name('save');
                Route::delete('/delete', [TruckController::class, 'delete'])->name('delete');
            });
    });
});

require __DIR__ . '/auth.php';
