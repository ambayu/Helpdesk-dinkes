<?php

namespace App\Http\Controllers\pages;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserTeams extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      // Mengambil objek pengguna yang login
      $user = Auth::user();
      $user->role = $user->getRoleNames()[0];
      $user->date = Carbon::parse($user->created_at)->format('Y-m-d');
      $roleCount = Role::where('name', $user->role)->first()->users->count();
      $user->roleCount = $roleCount;
      $user->all_role = Role::with(['users' => function ($query) {
        $query->take(3); // Ambil hanya 3 pengguna dari setiap peran
      }])->withCount('users')->get();

      if ($user->status == '1') {
        $user->status = 'Active';
      } else if ($user->status == '2') {
        $user->status = 'Pending';
      } else if ($user->status == '0') {
        $user->status = 'Non Aktif';
      }

      return view('content.pages.pages-profile-teams', compact('user'));
    }
  }
}
