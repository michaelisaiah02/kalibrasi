<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckRoleIsAdmin;
use App\Http\Middleware\CheckRoleMinUser;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
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

        Route::get('/input/repair-data', function () {
            return view('input.repair-data', [
                'title' => 'REPAIR DATA INPUT'
            ]);
        })->name('input.repair.data');


        Route::get('/report', [ReportController::class, 'menu'])->name('report.menu');
        Route::post('/report', [ReportController::class, 'search'])->name('report.search');

        // API data
        Route::get('/count-alat/{tipe_id}', [APIController::class, 'countEquipments'])->name('api.count.alat');
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
        Route::get('/admin/std-keberterimaan', [AdminController::class, 'keberterimaan'])->name('admin.std.keberterimaan');
    });
    // Route::post('/input-new-alat-ukur', [AlatUkurController::class, 'store'])->middleware('auth')->name('store.equipment');
});
