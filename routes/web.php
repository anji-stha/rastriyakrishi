<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear-config', function () {
    Artisan::call('config:clear');
    return 'Config cache cleared!';
});

Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        return 'Storage link created successfully!';
    } catch (\Exception $e) {
        return 'Failed to create storage link: ' . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/user/{id}/approve/{type}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/user/{id}/disapprove/{type}', [AdminController::class, 'disapprove'])->name('admin.disapprove');
    Route::get('/admin/user/{id}/{type}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/newusers', [AdminController::class, 'getNewUsers'])->name('admin.newusers');
    Route::get('/admin/existingusers', [AdminController::class, 'getExistingUsers'])->name('admin.existingusers');
});

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('authenticate');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('logout');
