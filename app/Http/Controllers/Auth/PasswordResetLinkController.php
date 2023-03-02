<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{


    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::send('emails.forgot-password', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset your password');
        });

        return response()->json(['message' => 'Email sent'], 200);
    }

    public function tokenfrontend(Request $request)
    {
        $token = $request->token;
        return redirect()->away('https://www.thevirtualbd.com/passwordreset?token='.$token);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed'
        ]);

        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $reset = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$reset) {
            return response()->json(['message' => 'Invalid reset link'], 400);
        }

        DB::table('users')
            ->where('email', $email)
            ->update(['password' => $password]);

        DB::table('password_resets')
            ->where('email', $email)
            ->delete();

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
