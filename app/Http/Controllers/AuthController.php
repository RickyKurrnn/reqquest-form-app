<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // public function login(Request $request)
    // {
    //     // VALIDASI
    //     $credentials = $request->validate([
    //         'email'    => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     // ATTEMPT LOGIN
    //     if (Auth::attempt($credentials, $request->boolean('remember'))) {
    //         $request->session()->regenerate();

    //         return redirect()->intended(route('form.list'));
    //     }

    //     // GAGAL LOGIN
    //     return back()->withErrors([
    //         'email' => 'Email atau password salah.',
    //     ])->onlyInput('email');
    // }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek user
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

        // CEK approval
        if ($user->is_approved !== 'approved') {
            return back()->withErrors([
                'email' => 'Akun Anda belum disetujui oleh admin.',
            ]);
        }


        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('form.list'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'is_approved' => 'pending', // DEFAULT ROLE
        ]);

        // Auth::login($user);
        // return redirect()->route('form.list');
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil. Tunggu persetujuan admin.');

    }

}
