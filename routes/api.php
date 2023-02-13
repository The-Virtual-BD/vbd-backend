<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\BloggerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter;

// Authentication route
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile route
    Route::controller(ProfileController::class)->group(function () {
        Route::put('/myprofile/pupdate/{user}', 'passwordup');
        Route::put('/myprofile/update/{user}', 'update');
        Route::put('/myprofile/profilePic/{user}', 'profilePic');
    });

    // Blogger routes
    Route::group(['prefix' => 'blogger'], function () {

        Route::post('/store/{user}', [BloggerController::class, 'store']);
    });


    // Category routes
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/catlist', [CategoryController::class, 'catlist']); // categories/catlist --get
        Route::post('/store', [CategoryController::class, 'store']); // categories/store --post
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy']); // categories/destroy/{category} --post
    });


    // Projects routes
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/myprojects', [ProjectController::class, 'myproject']); // projects/myprojects --get
        Route::get('/show/{project}', [ProjectController::class, 'show']); // projects/show/{project} --get
    });

    // Post Rout
    // 'middleware' => ['role:blogger']
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/myposts', [PostController::class, 'myposts']);
        Route::post('/store', [PostController::class, 'store']); // posts/store --post
        Route::get('/edit/{post}', [PostController::class, 'edit']);
        Route::put('/update/{post}', [PostController::class, 'update']);
        Route::delete('/destroy/{post}', [PostController::class, 'destroy']);
    });

    // Post Rout for admin
    Route::group(['prefix' => 'posts', 'middleware' => ['role:admin']], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/show/{pst}', [PostController::class, 'show']);
    });

    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::post('/store', [CommentController::class, 'store']);
        Route::put('/update/{comment}', [CommentController::class, 'update']);
        Route::delete('/destroy/{comment}', [CommentController::class, 'destroy']);
    });

    // Reviews
    Route::group(['prefix' => 'reviews'], function () {
        Route::post('/store', [ReviewController::class, 'store']);
        Route::post('/areviewes', [ReviewController::class, 'areviewes']);
    });

    // Subscription routes
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::post('/store/{user}', [SubscriptionController::class, 'store']);
    });


    Route::group(['prefix' => 'services'], function () {
        Route::get('/activeservices', [ServiceController::class, 'activeservices']);
    });
});
