<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NoticeController;

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

Route::get('/', [FeedbackController::class, 'index'])->name('home');

Route::post('/feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');
Route::get('/search-registration/{registrationNumber}', [AdminController::class, 'search'])->name('search.registration');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('user/{id}/approve/{type}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('user/{id}/disapprove/{type}', [AdminController::class, 'disapprove'])->name('admin.disapprove');
    Route::get('user/{id}/{type}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('newusers', [AdminController::class, 'getNewUsers'])->name('admin.newusers');
    Route::get('existingusers', [AdminController::class, 'getExistingUsers'])->name('admin.existingusers');
    Route::resource('notices', NoticeController::class);
    Route::resource('faqs', FaqController::class);
    Route::get('share-rate', [AdminController::class, 'showShareRateForm'])->name('admin.sharerate');
    Route::post('share-rate', [AdminController::class, 'setShareRate'])->name('admin.saveshare');
});

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('authenticate');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('logout');
Route::get('/faqs', [FAQController::class, 'faqs'])->name('faqs.public.index');
