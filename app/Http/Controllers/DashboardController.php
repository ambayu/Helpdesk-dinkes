<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Answer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  //
  public function index()
  {
    // $tickets = Ticket::where('id_user', auth()->user()->id)->get();
    // $ticketCounts = [
    //   'pending' => $tickets->where('status', 3)->count(),
    //   'proses' => $tickets->whereBetween('status', [4, 7])->count(),
    //   'finish' => $tickets->where('status', '>', 7)->count(),
    //   'total' => $tickets->count(),
    // ];
    $total_tiket = Ticket::count();

    $user = Auth::user();
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




    return view('content.apps.app-dashboard', compact('ticketCounts', 'total_tiket'));
  }
}
