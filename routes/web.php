<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckRoleIsAdmin;
use App\Http\Middleware\CheckRoleMinUser;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Input\NewEquipmentController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
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
        Route::get('/input/calibration-data', function () {
            return view('input.calibration-data', [
                'title' => 'CALIBRATION DATA INPUT'
            ]);
        })->name('input.calibration.data');
        Route::get('/input/repair-data', function () {
            return view('input.repair-data', [
                'title' => 'REPAIR DATA INPUT'
            ]);
        })->name('input.repair.data');

        Route::get('/report', [ReportController::class, 'menu'])->name('report.menu');
        Route::post('/report', [ReportController::class, 'search'])->name('report.search');

        // API data
        Route::get('/count-alat/{tipe_id}', function ($type_id) {
            $count = \App\Models\MasterList::where('type_id', $type_id)->count();
            return response()->json(['count' => $count]);
        });
        Route::get('/get-masterlist/{id_num}', function ($id_num) {
            $data = \App\Models\MasterList::with(['equipment', 'unit', 'standard'])
                ->where('id_num', $id_num)
                ->first();

            if (!$data) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            return response()->json([
                'sn_num' => $data->sn_num,
                'equipment_name' => $data->equipment->name ?? null,
                'capacity' => $data->capacity,
                'accuracy' => $data->accuracy,
                'unit' => $data->unit->unit ?? null,
                'merk' => $data->merk,
                'location' => $data->location,
                'calibration_type' => $data->calibration_type,
                'acceptance_criteria' => $data->acceptance_criteria,
                'standard' => $data->standard
            ]);
        });
    });
    // hanya admin
    Route::middleware(CheckRoleIsAdmin::class)->group(function () {
        // Route::resource('users', UserController::class);
        Route::get('/admin/users', [AdminController::class, 'user'])->name('admin.users');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
        Route::get('/admin/std-keberterimaan', [AdminController::class, 'keberterimaan'])->name('admin.std.keberterimaan');
    });
    // Route::post('/input-new-alat-ukur', [AlatUkurController::class, 'store'])->middleware('auth')->name('store.equipment');
});
