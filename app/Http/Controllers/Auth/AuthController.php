<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailOtpToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Send OTP to the given email address.
     * If the user does not exist yet, create a stub record so the email is reserved.
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = strtolower(trim($request->email));

        // Invalidate all previous unused OTPs for this email
        EmailOtpToken::where('email', $email)
            ->where('used', false)
            ->update(['used' => true]);

        // Generate 6-digit OTP
        $token = (string) random_int(100000, 999999);

        EmailOtpToken::create([
            'email'      => $email,
            'token'      => $token,
            'expires_at' => Carbon::now()->addMinutes(10),
            'used'       => false,
        ]);

        // In production, send a real transactional email here.
        // For local development, we write the OTP to the log so it can be read easily.
        Log::info("APEX AUTOMOTIVE — OTP Code for {$email}: {$token}");

        // If the mailer is not "log", send the mailable.
        if (config('mail.default') !== 'log') {
            // TODO: dispatch(new SendOtpMail($email, $token));
        }

        return redirect()->route('login')
            ->with('email_sent', $email)
            ->with('info', 'OTP kode telah dikirim ke email Anda. Berlaku 10 menit.');
    }

    /**
     * Show the OTP entry form.
     */
    public function showOtpForm(Request $request): View
    {
        return view('auth.otp', ['email' => $request->query('email', '')]);
    }

    /**
     * Verify the OTP and log the user in (or create their account).
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required', 'digits:6'],
        ]);

        $email = strtolower(trim($request->email));
        $otp   = $request->otp;

        /** @var EmailOtpToken|null $record */
        $record = EmailOtpToken::where('email', $email)
            ->where('token', $otp)
            ->where('used', false)
            ->where('expires_at', '>=', Carbon::now())
            ->latest()
            ->first();

        if (! $record) {
            return back()
                ->withInput()
                ->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.']);
        }

        // Mark the token as consumed
        $record->update(['used' => true]);

        // First-or-create the user
        $user = User::firstOrCreate(
            ['email' => $email],
            ['name'  => explode('@', $email)[0], 'password' => null]
        );

        Auth::login($user, remember: true);

        // Route new users (profile not completed) to the profile page
        if (! $user->hasCompletedProfile()) {
            return redirect()->route('profile.complete')
                ->with('welcome', true);
        }

        return redirect()->intended('/');
    }

    /**
     * Show the profile completion form.
     */
    public function showProfileComplete(): View
    {
        abort_if(! Auth::check(), 403);

        return view('auth.complete-profile');
    }

    /**
     * Persist the completed profile data for the authenticated user.
     */
    public function saveProfile(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'phone'       => ['required', 'string', 'max:20'],
            'nik'         => ['required', 'digits:16'],
            'npwp'        => ['nullable', 'string', 'max:20'],
            'address'     => ['required', 'string', 'max:500'],
            'city'        => ['required', 'string', 'max:100'],
            'province'    => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'digits_between:4,6'],
        ]);

        $user->update(array_merge($validated, ['profile_completed' => true]));

        return redirect('/')->with('profile_success', 'Profil berhasil disimpan! Anda sekarang dapat melakukan pemesanan.');
    }

    /**
     * Redirect user to Google OAuth page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback from Google OAuth.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => strtolower(trim($googleUser->getEmail()))],
                [
                    'name' => $googleUser->getName() ?: explode('@', $googleUser->getEmail())[0],
                    'password' => null,
                ]
            );

            Auth::login($user, remember: true);

            if (! $user->hasCompletedProfile()) {
                return redirect()->route('profile.complete')->with('welcome', true);
            }

            return redirect()->intended('/');
        } catch (\Throwable $e) {
            Log::error('Google Auth Failed: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            Log::error($e->getTraceAsString());
            return redirect()->route('login')->withErrors(['email' => 'Gagal login dengan akun Google: ' . $e->getMessage()]);
        }
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
