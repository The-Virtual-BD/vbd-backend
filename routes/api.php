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
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Api\NewsSubscriberController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\QuaryController;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter;

// Authentication route
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile route
    Route::controller(ProfileController::class)->group(function () {
        Route::put('/myprofile/pupdate', 'passwordup');
        Route::put('/myprofile/update', 'update');
        Route::put('/myprofile/profilePic', 'profilePic');
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
        Route::post('/store', [ProjectController::class, 'store']);
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


    // Comments
    Route::group(['prefix' => 'comments'], function () {
        Route::post('/store', [CommentController::class, 'store']);
        Route::put('/update/{comment}', [CommentController::class, 'update']);
        Route::delete('/destroy/{comment}', [CommentController::class, 'destroy']);
    });

    // Reviews
    Route::group(['prefix' => 'reviews'], function () {
        Route::post('/store', [ReviewController::class, 'store']);
        Route::get('/myreviews', [ReviewController::class, 'index']);
    });

    // Subscription routes
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::post('/store', [SubscriptionController::class, 'store']);
    });


});


// Newsletter Subscriber route
Route::group(['prefix' => 'newsSubscriber'], function () {
    Route::post('/store', [NewsSubscriberController::class, 'store']);
});
// Job Application Route
Route::group(['prefix' => 'jobapplications'], function () {
    Route::post('/store', [JobApplicationController::class, 'store']);
});

//Get all notice
Route::group(['prefix'=>'notices'], function (){
    Route::get('/allnotice', [NoticeController::class,'index']);
});


// Get all active posts
Route::group(['prefix'=>'posts'], function (){
    Route::get('/activeposts', [PostController::class,'activeposts']);
});

// Get all active services
Route::group(['prefix'=>'services'], function (){
    Route::get('/activeservices', [ServiceController::class,'activeservices']);
});
// Get all active projects
Route::group(['prefix'=>'projects'], function (){
    Route::get('/activeprojects', [ProjectController::class,'activeprojects']);
});


// Quary route
Route::group(['prefix'=>'queries'], function (){
    Route::post('/store', [QuaryController::class,'store']);
});
//
