<?php

namespace App\Http\Controllers\apps;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserViewAccount extends Controller
{
  public function index(User $user)
  {
    if (Auth::check()) {
      // Mengambil objek pengguna yang login


      $user->load('roleBidang.bidang.menuBidang', 'roles');
      $menu = Menu::all();

      $role = $user->roles[0]->name;
      $menuBidangIds = $user->roleBidang ? $user->roleBidang->bidang->menuBidang->pluck('id_menu')->toArray() : '';

      $countSelesai = Answer::filteredAnswers($user, $role, $menuBidangIds)
        ->where('status_answer', '>', 7)
        ->count();

      $countOnProses = Answer::filteredAnswers($user, $role, $menuBidangIds)
        ->whereBetween('status_answer', [4, 7])
        ->count();

      $countPending = Answer::filteredAnswers($user, $role, $menuBidangIds)
        ->where('status_answer', 0)
        ->count();

      $ticketCounts = [
        'pending' => $countPending,
        'proses' => $countOnProses,
        'finish' => $countSelesai,
        'total' => $countPending + $countOnProses + $countSelesai,
      ];

      $user->role = $user->getRoleNames()[0];
      $user->date = Carbon::parse($user->created_at)->format('Y-m-d');


      if ($user->status == '1') {
        $user->status = 'Active';
      } else if ($user->status == '2') {
        $user->status = 'Pending';
      } else if ($user->status == '0') {
        $user->status = 'Non Aktif';
      }
      return view('content.apps.app-user-view-account', compact('user', 'ticketCounts'));
    }
  }
  public function update(Request $request, $user)
  {
    // return $request;
    // Validate the input
    $request->validate([
      'newPassword' => ['required', 'string', 'min:6'],
      'confirmPassword' => ['required', 'same:newPassword'],
    ]);

    // Get the currently authenticated user
    $user = User::find($user);

    // Update the user's password
    $user->password = Hash::make($request->newPassword);
    $user->save();

    // Return a success message
    return redirect()->back()->with('success', 'Password has been updated successfully.');
  }
}
