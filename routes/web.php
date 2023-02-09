<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Homecontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test',  [Homecontroller::class,'test'])->name('test');


Route::put('profileUpdate/{user}', [ProfileController::class,'update'])->name('profileUpdate');
//
