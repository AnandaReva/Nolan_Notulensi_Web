<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\FinalizeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeetingController;
use App\Mail\Distribute_Meeting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'nolan.com', 'middleware' => ['auth', 'checkLogin']], function () {
    // Semua rute yang memerlukan kedua middleware: auth dan CheckAuthMiddleware
    Route::get('/home', [MeetingController::class, 'index'])->name('home');
    Route::get('/meeting/{id}', [MeetingController::class, 'show'])->name('meeting.show');


    Route::get('/meeting/{id}/finalize', [FinalizeController::class, 'finalizeShow'])->name('meeting.finalize');
    Route::post('/meeting/{id}/finalizing{idLogin}', [FinalizeController::class, 'finalizing'])->name('meeting.finalizing');

    Route::get('/meeting/{id}/approval/{idLogin}', [ApprovalController::class, 'approvalShow'])->name('meeting.approval');
    Route::post('/meeting/{id}/rejection/{idLogin}', [ApprovalController::class, 'rejection'])->name('meeting.reject');
    Route::post('/meeting/{id}/approving/{idLogin}', [ApprovalController::class, 'approving'])->name('meeting.approve');


    Route::get('/add', [MeetingController::class, 'add'])->name('meeting.add');
    Route::post('/meeting', [MeetingController::class, 'store'])->name('meeting.store');

    Route::get('/meeting/{id}/edit', [MeetingController::class, 'edit'])->name('meeting.edit');
    Route::put('/meeting/{id}/update', [MeetingController::class, 'update'])->name('meeting.update');
    Route::delete('/meeting/{id}', [MeetingController::class, 'destroy'])->name('meetings.destroy');
    // Route::delete('/meeting-file/{id}', [MeetingController::class, 'deleteFile'])->name('meeting.delete-file');
});

// Rute yang tidak memerlukan autentikasi
Route::get('/nolan.com/login', [AuthController::class, 'login'])->name('login');
Route::post('/nolan.com/login', [AuthController::class, 'authenticating']);
Route::get('/nolan.com/logout', [AuthController::class, 'logout']);

//Route::post('/contents', [MeetingController::class, 'store'])->name('content.store');
