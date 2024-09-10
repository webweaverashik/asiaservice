<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthenticateController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });
});

Route::controller(AuthenticateController::class)->group(function () {
    Route::get('login', 'login')->middleware('alreadyLoggedIn');
    Route::post('login', 'loginUser')->name('login');
    Route::get('logout', 'logout');

    Route::middleware('isLoggedIn')->group(function () {
        Route::get('/', function () {
            return redirect('dashboard')->with('warning', 'Already logged in');
        }); // to handle 404 redirect

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
        Route::get('upload', [FileUploadController::class, 'index']);
        Route::post('upload', [FileUploadController::class, 'storeAndPrepareData'])->name('upload.create');
        Route::get('file/{id}/view', [FileUploadController::class, 'pdfGeneration']);
        Route::get('file/{id}/delete', [FileUploadController::class, 'destroy']);
        

        Route::get('activity', [ActivityLogController::class, 'index']);
        
        Route::get('profile', [ProfileController::class, 'index']);
        Route::put('profile/edit', [ProfileController::class, 'update']);
    });
});