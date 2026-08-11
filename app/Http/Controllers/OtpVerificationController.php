<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class OtpVerificationController extends Controller
{
    public function show()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate(['otp_code' => 'required|digits:6']);

        $user = auth()->user();

        if ($user->otp_code !== $request->otp_code) {
            return back()->withErrors(['otp_code' => 'The code you entered is incorrect.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp_code' => 'This code has expired. Request a new one below.']);
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ])->save();

        return redirect()->route('dashboard')->with('success', 'Email verified — welcome!');
    }

    public function resend()
    {
        $user = auth()->user();
        $otp = (string) random_int(100000, 999999);

        $user->forceFill([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ])->save();

        Mail::to($user->email)->send(new OtpMail($otp, $user->name));

        return back()->with('status', 'A new code has been sent to your email.');
    }
}