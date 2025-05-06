<?php

use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\MasterListController;
use App\Http\Controllers\Admin\StandardController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Input\CalibrationDataController;
use App\Http\Controllers\Input\NewEquipmentController;
use App\Http\Controllers\Input\RepairDataController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\CheckRoleIsAdmin;
use App\Http\Middleware\CheckRoleMinUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/print-label/{id}', [PrintController::class, 'label'])->name('print.label');
    Route::get('/print-report/{id}', [PrintController::class, 'report'])->name('print.report');
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/report', [ReportController::class, 'menu'])->name('report.menu');
    Route::post('/report/search', [ReportController::class, 'search'])->name('report.search');
    Route::post('/report/masterlist', [ReportController::class, 'masterlist'])->name('report.masterlist');
    Route::post('/report/repairs', [ReportController::class, 'repairs'])->name('report.repairs');

    // hanya user ke atas
    Route::middleware(CheckRoleMinUser::class)->group(function () {
        Route::get('/input/new-equipment', [NewEquipmentController::class, 'create'])->name('input.new.equipment');
        Route::post('/input/new-equipment', [NewEquipmentController::class, 'store'])->name('store.equipment');

        Route::get('/input/calibration-data', [CalibrationDataController::class, 'create'])->name('input.calibration.data');
        Route::post('/input/calibration-data', [CalibrationDataController::class, 'store'])->name('store.calibration');

        Route::get('/input/repair-data', [RepairDataController::class, 'create'])->name('input.repair.data');
        Route::post('/input/repair-data', [RepairDataController::class, 'store'])->name('store.repair.data');

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
            Route::get('/search', [UserController::class, 'search'])->name('admin.users.search');
        });
        Route::prefix('admin/standards')->group(function () {
            Route::get('/', [StandardController::class, 'index'])->name('admin.standards.index');
            Route::post('/store', [StandardController::class, 'store'])->name('admin.standards.store');
            Route::post('/update-standard/{id}', [StandardController::class, 'update'])->name('admin.standards.update');
            Route::delete('/delete-standard/{id}', [StandardController::class, 'destroy']);
            Route::get('/search', [StandardController::class, 'search'])->name('admin.standards.search');
        });
        Route::prefix('admin/units')->group(function () {
            Route::get('/', [UnitController::class, 'index'])->name('admin.units.index');
            Route::post('/store', [UnitController::class, 'store'])->name('admin.units.store');
            Route::post('/update-unit/{id}', [UnitController::class, 'update'])->name('admin.units.update');
            Route::delete('/delete-unit/{id}', [UnitController::class, 'destroy']);
            Route::get('/search', [UnitController::class, 'search'])->name('admin.units.search');
        });
        Route::prefix('admin/equipments')->group(function () {
            Route::get('/', [EquipmentController::class, 'index'])->name('admin.equipments.index');
            Route::post('/store', [EquipmentController::class, 'store'])->name('admin.equipments.store');
            Route::post('/update-equipment/{id}', [EquipmentController::class, 'update'])->name('admin.equipments.update');
            Route::delete('/delete-equipment/{id}', [EquipmentController::class, 'destroy']);
            Route::get('/search', [EquipmentController::class, 'search'])->name('admin.equipments.search');
        });
        Route::prefix('admin/master-lists')->group(function () {
            Route::get('/', [MasterListController::class, 'index'])->name('admin.master-lists.index');
            Route::post('/store', [MasterListController::class, 'store'])->name('admin.master-lists.store');
            Route::post('/update-master-list/{id}', [MasterListController::class, 'update'])->name('admin.master-lists.update');
            Route::delete('/delete-master-list/{id}', [MasterListController::class, 'destroy']);
            Route::get('/search', [MasterListController::class, 'search'])->name('admin.master-lists.search');
        });
    });
    // Route::post('/input-new-alat-ukur', [AlatUkurController::class, 'store'])->middleware('auth')->name('store.equipment');
});
