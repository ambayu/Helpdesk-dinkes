<?php

namespace App\Http\Controllers\apps;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserViewAccount extends Controller
{
  public function index(User $user)
  {
    if (Auth::check()) {
      // Mengambil objek pengguna yang login

      $user->role = $user->getRoleNames()[0];
      $user->date = Carbon::parse($user->created_at)->format('Y-m-d');


      if ($user->status == '1') {
        $user->status = 'Active';
      } else if ($user->status == '2') {
        $user->status = 'Pending';
      } else if ($user->status == '0') {
        $user->status = 'Non Aktif';
      }
      return view('content.apps.app-user-view-account', compact('user'));
    }
  }
}
