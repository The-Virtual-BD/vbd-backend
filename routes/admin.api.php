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
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\NewsSubscriberController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\VaccancyController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\QuaryController;
use App\Http\Controllers\Api\SubChatController;

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

    // Notice controller
    Route::apiResource('notices', NoticeController::class);



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
        Route::put('/approve/{subscription}', [SubscriptionController::class, 'approve']);
        Route::put('/decline/{subscription}', [SubscriptionController::class, 'decline']);
        Route::delete('/destroy/{subscription}', [SubscriptionController::class, 'destroy']);
    });

    Route::group(['prefix' => 'subchat'], function(){
        Route::post('/store',[SubChatController::class,'store']);
    });


    // Media handeling
    Route::post('/tempUpload', [UploadController::class, 'tempUpload']);
    Route::delete('/media/{media}/delete', [UploadController::class, 'mediaDelete'])->name('mediaDelete');



    // Projects
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/show/{project}', [ProjectController::class, 'show']);
        Route::post('/store', [ProjectController::class, 'store']);
        Route::put('/approve/{project}', [ProjectController::class, 'approve']);
        Route::delete('/destroy/{project}', [ProjectController::class, 'destroy']);
    });


    // Blogger routes
    Route::group(['prefix' => 'bloggerApplication'], function () {
        Route::get('/', [BloggerController::class, 'index']);
        Route::get('/{blogger}', [BloggerController::class, 'show']);
        Route::put('/approve/{blogger}', [BloggerController::class, 'approve']);
        Route::put('/decline/{blogger}', [BloggerController::class, 'decline']);
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
        Route::put('/decline/{comment}', [CommentController::class, 'decline']);
        Route::delete('/destroy/{comment}', [CommentController::class, 'destroy']);
    });

    // Review Route
    Route::group(['prefix' => 'reviews'], function () {
        Route::get('/', [ReviewController::class, 'areviewes']);
        Route::get('/actreview', [ReviewController::class, 'actreview']);
        Route::put('/approve/{review}', [ReviewController::class, 'approve']);
        Route::put('/decline/{review}', [ReviewController::class, 'decline']);
        Route::delete('/destroy/{review}', [ReviewController::class, 'destroy']);
    });


    // Newsletter route
    Route::group(['prefix' => 'newsletters'], function () {
        Route::get('/', [NewsletterController::class, 'index']);
        Route::get('/{newsletter}', [NewsletterController::class, 'show']);
        Route::get('/send/{newsletter}', [NewsletterController::class, 'send']);
        Route::post('/store', [NewsletterController::class, 'store']);
        Route::put('/update/{newsletter}', [NewsletterController::class, 'update']);
        Route::delete('/destroy/{newsletter}', [NewsletterController::class, 'destroy']);
    });

    // Newsletter Subscriber route
    Route::group(['prefix' => 'newsSubscriber'], function () {
        Route::get('/', [NewsSubscriberController::class, 'index']);
        Route::post('/store', [NewsSubscriberController::class, 'store']);
        Route::put('/update/{subscriber}', [NewsSubscriberController::class, 'update']);
        Route::put('/toggle/{subscriber}', [NewsSubscriberController::class, 'toggle']);
        Route::delete('/destroy/{subscriber}', [NewsSubscriberController::class, 'destroy']);
    });


    // Vaccancy Route
    Route::group(['prefix' => 'vaccancies'], function () {
        Route::get('/', [VaccancyController::class, 'index']);
        Route::get('/{vaccancy}', [VaccancyController::class, 'show']);
        Route::post('/store', [VaccancyController::class, 'store']);
        Route::put('/update/{vaccancy}', [VaccancyController::class, 'update']);
        Route::delete('/destroy/{vaccancy}', [VaccancyController::class, 'destroy']);
    });


    // Job Application Route
    Route::group(['prefix' => 'jobapplications'], function () {
        Route::get('/', [JobApplicationController::class, 'index']);
        Route::get('/{application}', [JobApplicationController::class, 'show']);
        Route::delete('/destroy/{application}', [JobApplicationController::class, 'destroy']);
    });

    // Quary route
    Route::group(['prefix'=>'queries'], function (){
        Route::get('/', [QuaryController::class,'index']);
        Route::get('/{quary}', [QuaryController::class,'show']);
        Route::post('/replay/{quary}', [QuaryController::class,'replay']);
        Route::delete('/destroy/{quary}', [QuaryController::class,'destroy']);
    });
});
