<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginBasic extends Controller
{



  public function index()
  {
    if (Auth::check()) {
      return redirect('/pages/profile-user');
    }

    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }


  public function loginMasuk(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255',
      'password' => 'required|string|min:6',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      if ($user->status != 1) {
        Auth::logout();

        throw ValidationException::withMessages(['status' => 'Akun anda tidak aktif. Harap hubungi administrator.']);
      }
      // Jika login berhasil, redirect ke halaman yang diinginkan
      return redirect()->intended('/dashboard');
    }

    // Jika login gagal, kembali ke halaman login dengan pesan error
    return redirect()->back()->withErrors(['username' => 'Username atau password salah']);
  }
}
