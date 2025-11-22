<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * buat login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        // user login & check database
        $credentials = [
            'email' => $username,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            // kalau status user Inactive, jangan boleh masuk
            if (Auth::user()->status === 'Inactive') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'username' => 'Akun kamu sedang tidak aktif. Silakan hubungi admin untuk mengaktifkan kembali.',
                ])->onlyInput('username');
            }

            $request->session()->regenerate();

            // cek kalau user admin/bukan
            if (Auth::user()->is_admin) {
                session(['admin' => true]);
            }

            return redirect()->intended(route('landing'));
        }

        return back()->withErrors([
            'username' => 'Email Atau Kata Sandi Tidak Sesuai Resep Nih. Silakan Coba Lagi Ya.',
        ])->onlyInput('username');
    }

    /**
     * logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('admin');
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.landing');
    }

    /**
     * kirim password reset link ke email user.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $token = Str::random(64);

        $resetData = [
            'email' => $request->email,
            'token' => $token,
            'expires_at' => now()->addMinutes(30),
        ];

        $request->session()->put('password_reset', $resetData);

        $resetLink = url('/password/reset/' . $token);

        Mail::raw('Klik Tautan Ini Untuk Meracik Ulang Password MasakKu Anda: ' . $resetLink, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('MasakKu Password Reset');
        });

        return back()->with('status', 'Kami Sudah Mengirimkan Resep Reset Password Email Mu!');
    }

    /**
     * user registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|regex:/@gmail\\.com$/i',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $verificationCode = random_int(100000, 999999);

        $pendingData = [
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Active',
            'is_admin' => false,
            'code' => $verificationCode,
            'expires_at' => now()->addMinutes(15),
        ];

        $request->session()->put('register_verification', $pendingData);

        Mail::raw('Ini Adalah Resep Verifikasi Mu Yang Paling Up To Date: ' . $verificationCode, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Resep Verifikasi');
        });

        return redirect()->route('register.verify.form')->with('status', 'Kami Sudah Mengirimkan Email Verifikasi Pada Email Mu!');
    }

    /**
     * nampilin verification form buat registration code.
     */
    public function showRegisterVerificationForm(Request $request)
    {
        if (! $request->session()->has('register_verification')) {
            return redirect()->route('register')->withErrors([
                'email' => 'Mohon Mengisi Form Registrasi Terlebih Dahulu Ya!.',
            ]);
        }

        return view('auth.verify-register');
    }

    /**
     * verify regis code dan create user.
     */
    public function verifyRegisterCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $pendingData = $request->session()->get('register_verification');

        if (! $pendingData) {
            return redirect()->route('register')->withErrors([
                'email' => 'Adonan Pendaftaranmu Sudah Dingin. Mohon Register Lagi Ya.',
            ]);
        }

        if (isset($pendingData['expires_at']) && now()->greaterThan($pendingData['expires_at'])) {
            $request->session()->forget('register_verification');

            return redirect()->route('register')->withErrors([
                'email' => 'Ups-resep verifikasi sudah tidak Up to Date. Mohon daftar ulang supaya bisa kembali ke dapur.',
            ]);
        }

        if ($request->code != $pendingData['code']) {
            return back()->withErrors([
                'code' => 'Harap periksa kembali resep Verifikasi nya ya!.',
            ])->withInput();
        }

        $user = User::create([
            'name' => $pendingData['name'],
            'email' => $pendingData['email'],
            'password' => $pendingData['password'],
            'status' => $pendingData['status'],
            'is_admin' => $pendingData['is_admin'],
        ]);

        $request->session()->forget('register_verification');

        Auth::login($user);

        return redirect()->route('landing');
    }

    /**
     * reset password pake link.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $resetData = $request->session()->get('password_reset');

        if (! $resetData || $resetData['token'] !== $request->token) {
            return back()->withErrors(['password' => 'Tautan Reset Password Ini Sudah Basi. Silakan Ajukan Resep Baru Ya!']);
        }

        if (isset($resetData['expires_at']) && now()->greaterThan($resetData['expires_at'])) {
            $request->session()->forget('password_reset');

            return back()->withErrors(['password' => 'Tautan Reset Password Ini Sudah Basi. Silakan Ajukan Resep Baru Ya!']);
        }

        $user = User::where('email', $resetData['email'])->first();

        if (! $user) {
            $request->session()->forget('password_reset');

            return back()->withErrors(['password' => 'Kami Tidak Dapat Menemukan Resep Email Mu Nih, Pastiin Email Mu Benar Ya!']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->forget('password_reset');

        return redirect()->route('login')->with('status', 'Password Mu Sudah Menggunakan Resep yang Up To Date!.');
    }

    /**
     * tampilin edit profile form buat authenticated user.
     */
    public function editProfile(Request $request)
    {
        $user = $request->user();
        return view('profile-edit', compact('user'));
    }

    /**
     * Update authentikasi user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'birthday' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;

        // Foto Profil
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/profile_pictures'), $filename);
            $user->profile_picture = 'profile_pictures/' . $filename;
        }

        if ($request->filled('password')) {
            if (! $request->filled('current_password') || ! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile Berhasil Di Update!.');
    }
}

