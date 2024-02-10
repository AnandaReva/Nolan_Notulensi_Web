<?php

use App\Mail\DistributeEmail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::middleware(['auth:sanctum'])->group(function () {;
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('PostOwner');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('PostOwner');


    Route::post('/comment/{id}', [CommentController::class, 'storeComment']);
    Route::patch('/comment/{id}', [CommentController::class, 'updateComment'])->middleware('CommentOwner');
    Route::delete('/comment/{id}', [CommentController::class, 'destroyComment'])->middleware('CommentOwner');
}); */


//Route::get("meetings", "MeetingController");

//Email
/*
Route::get('distribute')->get( function ( ) {
    $email = new DistributeEmail();
    Mail::to('namadepannamabelakang1781945@gmail.com')->send($email);
}); */
