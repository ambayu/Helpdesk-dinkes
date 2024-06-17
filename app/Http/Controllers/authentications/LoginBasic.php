<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
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
      // Jika login berhasil, redirect ke halaman yang diinginkan
      return redirect()->intended('/pages/profile-user');
    }

    // Jika login gagal, kembali ke halaman login dengan pesan error
    return redirect()->back()->withErrors(['username' => 'Username atau password salah']);
  }
}
