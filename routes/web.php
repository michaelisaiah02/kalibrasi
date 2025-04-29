<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Middleware\CheckRoleIsAdmin;
use App\Http\Middleware\CheckRoleMinUser;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\StandardController;
use App\Http\Controllers\Input\RepairDataController;
use App\Http\Controllers\Input\NewEquipmentController;
use App\Http\Controllers\Input\CalibrationDataController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // hanya user ke atas
    Route::middleware(CheckRoleMinUser::class)->group(function () {
        Route::get('/input/new-equipment', [NewEquipmentController::class, 'create'])->name('input.new.equipment');
        Route::post('/input/new-equipment', [NewEquipmentController::class, 'store'])->name('store.equipment');

        Route::get('/input/calibration-data', [CalibrationDataController::class, 'create'])->name('input.calibration.data');
        Route::post('/input/calibration-data', [CalibrationDataController::class, 'store'])->name('store.calibration');

        Route::get('/input/repair-data', [RepairDataController::class, 'create'])->name('input.repair.data');
        Route::post('/input/repair-data', [RepairDataController::class, 'store'])->name('store.repair.data');


        Route::get('/report', [ReportController::class, 'menu'])->name('report.menu');
        Route::post('/report', [ReportController::class, 'search'])->name('report.search');

        // API data
        Route::get('/count-equipments/{type_id}', [APIController::class, 'countEquipments'])->name('api.count.equipments');
        Route::get('/get-masterlist/{id_num}', [APIController::class, 'getMasterList'])->name('api.get.masterlist');
    });
    // hanya admin
    Route::middleware(CheckRoleIsAdmin::class)->group(function () {
        // Route::resource('users', UserController::class);
        Route::prefix('admin/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
            Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
            Route::post('/update-user/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);
        });
        Route::prefix('admin/acceptance-criteria')->group(function () {
            Route::get('/', [StandardController::class, 'index'])->name('admin.acceptance.criteria.index');
            Route::post('/store', [StandardController::class, 'store'])->name('admin.acceptance.criteria.store');
            Route::post('/update-acceptance-criteria/{id}', [StandardController::class, 'update'])->name('admin.acceptance.criteria.update');
            Route::delete('/delete-acceptance-criteria/{id}', [StandardController::class, 'destroy']);
        });
    });
    // Route::post('/input-new-alat-ukur', [AlatUkurController::class, 'store'])->middleware('auth')->name('store.equipment');
});
