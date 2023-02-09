<?php

use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\ReviewController;



// Authentication route
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::controller(ProfileController::class)->group(function () {
        Route::put('/myprofile/pupdate/{user}', 'passwordup');
        Route::put('/myprofile/update/{user}', 'update');
    });









    // Blogger routes
    Route::post('/blogger/create', [BloggerController::class, 'store']);

    // Post Rout
    Route::group(['prefix' => 'posts', 'middleware' => ['role:blogger']], function () {
        Route::get('/myposts', [PostController::class, 'myposts']);
        Route::post('/store', [PostController::class, 'store']);
        Route::get('/edit/{post}', [PostController::class, 'edit']);
        Route::put('/update/{post}', [PostController::class, 'update']);
        Route::delete('/destroy/{post}', [PostController::class, 'destroy']);
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/store', [CommentController::class, 'store']);
        Route::put('/update/{comment}', [CommentController::class, 'update']);
        Route::delete('/destroy/{comment}', [CommentController::class, 'destroy']);
    });

    Route::group(['prefix' => 'reviews'], function () {
        Route::post('/store', [ReviewController::class, 'store']);
        Route::post('/areviewes', [ReviewController::class, 'areviewes']);
    });

    // Subscription routes
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::post('/store', [SubscriptionController::class, 'store']);
    });
});
