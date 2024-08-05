<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  //
  public function index()
  {
    $tickets = Ticket::where('id_user', auth()->user()->id)->get();
    $ticketCounts = [
      'pending' => $tickets->where('status', 3)->count(),
      'proses' => $tickets->whereBetween('status', [4, 7])->count(),
      'finish' => $tickets->where('status', '>', 7)->count(),
      'total' => $tickets->count(),
    ];
    $total_tiket = Ticket::count();


    return view('content.apps.app-dashboard', compact('ticketCounts', 'total_tiket'));
  }
}
