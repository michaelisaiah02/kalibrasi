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
use App\Http\Middleware\CheckIncompleteInput;
use App\Http\Middleware\CheckRoleIsAdmin;
use App\Http\Middleware\CheckRoleMinUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ping', function () {
    return response()->json(['pong' => true]);
})->name('ping');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/print-label/{id}', [PrintController::class, 'label'])->name('print.label');
    Route::middleware(CheckRoleMinUser::class)->controller(APIController::class)->group(function () {
        // API data
        Route::get('/count-equipments/{type_id}', 'countEquipments')->name('api.count.equipments');
        Route::get('/get-masterlist/{id_num}', 'getMasterList')->name('api.get.masterlist');
        Route::get('/get-actual-value/{id}', 'getActualValue')->name('api.get.actual.value');
        Route::get('/get-repair-data/{id}', 'getRepairData')->name('api.get.repair.data');
    });
    Route::middleware(CheckIncompleteInput::class)->group(function () {
        Route::controller(PrintController::class)->group(function () {
            Route::get('/print-report-masterlist/{id}', 'reportMasterlist')->name('print.report.masterlist');
            Route::get('/print-report-repair/{id}', 'reportRepair')->name('print.report.repair');
            Route::post('/update-masterlist-print/{result}', 'updateMasterListPrint')->name('update.masterlist.print');
        });
        Route::controller(ReportController::class)->group(function () {
            Route::get('/report', 'menu')->name('report.menu');
            Route::get('/report/search', 'search')->name('report.search');
            Route::post('/report/masterlist', 'masterlist')->name('report.masterlist');
            Route::post('/report/repairs', 'repairs')->name('report.repairs');
        });
    });

    // hanya user ke atas
    Route::middleware(CheckRoleMinUser::class)->middleware(CheckIncompleteInput::class)->group(function () {
        Route::controller(NewEquipmentController::class)->group(function () {
            Route::get('/input/new-equipment', 'create')->name('input.new.equipment');
            Route::post('/input/new-equipment', 'store')->name('store.equipment');
        });

        Route::controller(CalibrationDataController::class)->group(function () {
            Route::get('/input/calibration-data', 'create')->name('input.calibration.data');
            Route::post('/input/calibration-data', 'store')->name('store.calibration');
            Route::post('/input/calibration-data/{id}', 'edit')->name('edit.calibration');
        });

        Route::controller(RepairDataController::class)->group(function () {
            Route::get('/input/repair-data', 'create')->name('input.repair');
            Route::post('/input/repair-data', 'store')->name('store.repair');
            Route::post('/input/repair-data/{id}', 'edit')->name('edit.repair');
        });
        Route::post('/standards/store', [DashboardController::class, 'store'])->name('standards.store');

        // hanya admin
        Route::middleware(CheckRoleIsAdmin::class)->group(function () {
            Route::prefix('admin/users')->controller(UserController::class)->group(function () {
                Route::get('/', 'index')->name('admin.users.index');
                Route::post('/store', 'store')->name('admin.users.store');
                Route::post('/update-user/{id}', 'update')->name('admin.users.update');
                Route::delete('/delete-user/{id}', 'destroy');
                Route::get('/search', 'search')->name('admin.users.search');
            });
            Route::prefix('admin/standards')->controller(StandardController::class)->group(function () {
                Route::get('/', 'index')->name('admin.standards.index');
                Route::post('/update-standard/{id}', 'update')->name('admin.standards.update');
                Route::post('/store', 'store')->name('admin.standards.store');
                Route::delete('/delete-standard/{id}', 'destroy');
                Route::get('/search', 'search')->name('admin.standards.search');
            });
            Route::prefix('admin/units')->controller(UnitController::class)->group(function () {
                Route::get('/', 'index')->name('admin.units.index');
                Route::post('/store', 'store')->name('admin.units.store');
                Route::post('/update-unit/{id}', 'update')->name('admin.units.update');
                Route::delete('/delete-unit/{id}', 'destroy');
                Route::get('/search', 'search')->name('admin.units.search');
            });
            Route::prefix('admin/equipments')->controller(EquipmentController::class)->group(function () {
                Route::get('/', 'index')->name('admin.equipments.index');
                Route::post('/store', 'store')->name('admin.equipments.store');
                Route::post('/update-equipment/{id}', 'update')->name('admin.equipments.update');
                Route::delete('/delete-equipment/{id}', 'destroy');
                Route::get('/search', 'search')->name('admin.equipments.search');
            });
            Route::prefix('admin/master-lists')->controller(MasterListController::class)->group(function () {
                Route::get('/', 'index')->name('admin.master-lists.index');
                Route::post('/store', 'store')->name('admin.master-lists.store');
                Route::post('/update-master-list/{id}', 'update')->name('admin.master-lists.update');
                Route::delete('/delete-master-list/{id}', 'destroy');
                Route::get('/search', 'search')->name('admin.master-lists.search');
                Route::get('/master/export', 'export')->name('admin.master-lists.export');
            });
        });
    });
});
