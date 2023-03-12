<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Homecontroller;
use App\Mail\NewsletterMail;
use App\Mail\UserWelcome;
use App\Models\Newsletter;
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



Route::group(['prefix' => 'email'], function () {
    Route::get('/welcomemail',function ()
    {   $message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.';
        return (new UserWelcome($message))->render();
    });
    Route::get('/newsletteremail',
        function ()
        {
            $newsletter = Newsletter::first();
            return (new NewsletterMail($newsletter))->render();
        }
    );
    Route::get('/querymail',
        function ()
        {
            $message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.';
            return view('emails.querymail',compact('message'));
        }
    );
    Route::get('/queryreplay',
        function ()
        {
            $message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sapien velit, aliquet eget commodo nec, auctor a sapien. Nam eu neque vulputate diam rhoncus faucibus. Curabitur quis varius libero. Lorem.';
            return view('emails.queryreplay',compact('message'));
        }
    );
});
//
