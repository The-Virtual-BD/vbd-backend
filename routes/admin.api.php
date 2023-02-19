<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\BloggerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {

    // Category routes
    Route::apiResource('categories', CategoryController::class);



    // Role routes
    Route::get('/roles', [RoleController::class, 'allRoles']);
    Route::post('/role/create', [RoleController::class, 'createRole']);
    Route::get('/role/{id}', [RoleController::class, 'edit']);
    Route::put('/role/update/{id}', [RoleController::class, 'updateRole']);
    Route::delete('/role/destroy/{id}', [RoleController::class, 'destroy']);

    // Permission routes
    Route::get('/permissions', [PermissionController::class, 'allPermissions']);
    Route::post('/permission/create', [PermissionController::class, 'createPermission']);
    Route::get('/permission/{id}', [PermissionController::class, 'edit']);
    Route::put('/permission/update/{id}', [PermissionController::class, 'updatePermission']);
    Route::delete('/permission/destroy/{id}', [PermissionController::class, 'destroy']);

    // User routes
    Route::get('/users', [UserController::class, 'allUser']);
    Route::post('/user/create', [UserController::class, 'create']);
    Route::get('/user/{user}', [UserController::class, 'getUser']);
    Route::put('/user/update/{user}', [UserController::class, 'update']);
    Route::delete('/user/destroy/{user}', [UserController::class, 'destroy']);

    // Service routes
    Route::get('/services', [ServiceController::class, 'allService']);
    Route::post('/service/create', [ServiceController::class, 'create']);
    Route::get('/service/{service}', [ServiceController::class, 'getService']);
    Route::put('/service/update/{service}', [ServiceController::class, 'update']);
    Route::delete('/service/destroy/{service}', [ServiceController::class, 'destroy']);

    // Subscription routes
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/', [SubscriptionController::class, 'index']);
        Route::get('/{subscription}', [SubscriptionController::class, 'show']);
        Route::put('/update/{subscription}', [SubscriptionController::class, 'update']);
        Route::delete('/destroy/{subscription}', [SubscriptionController::class, 'destroy']);
    });


    // Media handeling
    Route::post('/tempUpload', [UploadController::class, 'tempUpload']);
    Route::delete('/media/{media}/delete', [UploadController::class, 'mediaDelete'])->name('mediaDelete');



    // Projects
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/show/{project}', [ProjectController::class, 'show']);
        Route::post('/store', [ProjectController::class, 'store']);
        Route::put('/approve/{comment}', [ProjectController::class, 'approve']);
        Route::delete('/destroy/{comment}', [ProjectController::class, 'destroy']);
    });


    // Blogger routes
    Route::group(['prefix' => 'bloggerApplication'], function () {
        Route::get('/', [BloggerController::class, 'index']);
        Route::get('/{blogger}', [BloggerController::class, 'show']);
        Route::put('/approve/{blogger}', [BloggerController::class, 'approve']);
        Route::delete('/destroy/{blogger}', [BloggerController::class, 'destroy']);
    });


    // Post Route
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/show/{post}', [PostController::class, 'show']);
        Route::put('/approve/{post}', [PostController::class, 'approve']);
        Route::put('/decline/{post}', [PostController::class, 'decline']);
        Route::delete('/destroy/{post}', [PostController::class, 'destroy']);
    });

    // Comment Route
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [CommentController::class, 'index']);
        Route::get('/show/{comment}', [CommentController::class, 'show']);
        Route::put('/approve/{comment}', [CommentController::class, 'approve']);
        Route::delete('/destroy/{comment}', [CommentController::class, 'destroy']);
    });

    // Review Route
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('/', [ReviewController::class, 'index']);
        Route::put('/approve/{review}', [ReviewController::class, 'approve']);
        Route::delete('/destroy/{review}', [ReviewController::class, 'destroy']);
    });
});
