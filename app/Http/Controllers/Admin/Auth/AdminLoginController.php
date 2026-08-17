<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = strtolower($credentials['email']) . '|' . $request->ip();

        // ব্রুট-ফোর্স প্রোটেকশন: ৫ বার ভুল দিলে ১ মিনিট লক
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'email' => "অনেকবার ভুল চেষ্টা হয়েছে। {$seconds} সেকেন্ড পরে আবার চেষ্টা করো।",
            ]);
        }

        $remember = $request->boolean('remember');

        if (!Auth::guard('admin')->attempt($credentials, $remember)) {
            RateLimiter::hit($throttleKey, 60); // ৬০ সেকেন্ডের জন্য গণনা করবে

            Log::warning('Failed admin login attempt', [
                'email' => $credentials['email'],
                'ip'    => $request->ip(),
            ]);

            throw ValidationException::withMessages([
                'email' => 'ইমেইল অথবা পাসওয়ার্ড সঠিক নয়।',
            ]);
        }

        RateLimiter::clear($throttleKey);

        // সেশন ফিক্সেশন অ্যাটাক ঠেকাতে লগইনের পর সেশন আইডি রিজেনারেট করা হচ্ছে
        $request->session()->regenerate();

        $admin = Auth::guard('admin')->user();
        $admin->forceFill([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ])->saveQuietly();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}