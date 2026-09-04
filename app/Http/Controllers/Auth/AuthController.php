<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailOtpToken;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

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
            'email' => $email,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
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
            'otp' => ['required', 'digits:6'],
        ]);

        $email = strtolower(trim($request->email));
        $otp = $request->otp;

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
            ['name' => explode('@', $email)[0], 'password' => null]
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
            'name'           => ['required', 'string', 'max:255'],
            'phone'          => ['required', 'string', 'max:20'],
            'nik'            => ['required', 'digits:16'],
            'npwp'           => ['nullable', 'string', 'max:20'],
            'address'        => ['required', 'string', 'max:500'],
            'city'           => ['required', 'string', 'max:100'],
            'province'       => ['required', 'string', 'max:100'],
            'postal_code'    => ['required', 'digits_between:4,6'],
            'ownership_type' => ['required', 'in:individual,company'],
            'ktp_file'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'kk_file'        => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'nib_file'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'akta_file'      => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $fileFields = ['ktp_file', 'kk_file', 'nib_file', 'akta_file'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('kyc_documents', 'public');
                $validated[$field] = $path;
            }
        }

        $user->update(array_merge($validated, [
            'profile_completed' => true,
            'kyc_status'        => 'pending',
        ]));

        return redirect()->route('portal.dashboard')
            ->with('profile_success', 'Profil & berkas legalitas KYC berhasil disimpan! Tim Compliance akan memverifikasi dokumen Anda.');
    }

    /**
     * Redirect user to Google OAuth page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback from Google OAuth.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $driver = Socialite::driver('google');

            // Fix for local XAMPP Windows cURL SSL certificate verification issue
            if (app()->environment('local')) {
                $guzzleClient = new Client(['verify' => false]);
                $driver->setHttpClient($guzzleClient);
            }

            $googleUser = $driver->user();

            $user = User::firstOrCreate(
                ['email' => strtolower(trim($googleUser->getEmail()))],
                [
                    'name' => $googleUser->getName() ?: explode('@', $googleUser->getEmail())[0],
                    'password' => null,
                ]
            );

            Auth::login($user, remember: true);

            if ($user->isRm()) {
                return redirect()->route('admin.inquiries.index');
            }

            if ($user->isDelivery()) {
                return redirect()->route('delivery.portal');
            }

            if (! $user->hasCompletedProfile()) {
                return redirect()->route('profile.complete')->with('welcome', true);
            }

            return redirect()->intended('/');
        } catch (\Throwable $e) {
            Log::error('Google Auth Failed: '.$e->getMessage().' in '.$e->getFile().':'.$e->getLine());
            Log::error($e->getTraceAsString());

            return redirect()->route('login')->withErrors(['email' => 'Gagal login dengan akun Google: '.$e->getMessage()]);
        }
    }

    /**
     * Authenticate user via QR Code from VIP ID Card.
     */
    public function loginQr(Request $request): JsonResponse
    {
        $payload = $request->input('qr_payload');

        if (! $payload) {
            return response()->json(['success' => false, 'message' => 'QR Code tidak terdeteksi.'], 400);
        }

        $parts = explode('|', $payload);
        if (count($parts) !== 3 || $parts[0] !== 'qrlogin') {
            return response()->json(['success' => false, 'message' => 'Format QR Code tidak valid.'], 422);
        }

        $userId = $parts[1];
        $hash   = $parts[2];

        $user = User::find($userId);
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.'], 404);
        }

        $secret = config('app.key');
        $expectedHash = hash_hmac('sha256', $user->nik ?? $user->email, $secret);

        if (! hash_equals($expectedHash, $hash)) {
            return response()->json(['success' => false, 'message' => 'QR Code tidak valid atau telah dimanipulasi.'], 403);
        }

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        $redirect = route('home');
        if ($user->isRm()) {
            $redirect = route('admin.inquiries.index');
        } elseif ($user->isDelivery()) {
            $redirect = route('delivery.portal');
        } elseif (! $user->hasCompletedProfile()) {
            $redirect = route('profile.complete');
        } else {
            $redirect = route('portal.dashboard');
        }

        return response()->json([
            'success'  => true,
            'message'  => 'Autentikasi ID Card Berhasil! Mengalihkan...',
            'redirect' => $redirect,
        ]);
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
