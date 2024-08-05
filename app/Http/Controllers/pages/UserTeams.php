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

    // Mengambil objek pengguna yang login
    $user = Auth::user();
    $user->role = $user->getRoleNames()[0];

    $user->date = Carbon::parse($user->created_at)->format('Y-m-d');
    $roleCount = Role::where('name', $user->role)->first()->users->count();
    $user->roleCount = $roleCount;

    $roles = Role::withCount('users')->with('users')->get();

    return view('content.pages.pages-profile-teams', compact(
      'user',
      'roles'
    ));
  }
}
