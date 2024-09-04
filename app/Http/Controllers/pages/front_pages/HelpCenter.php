<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Models\Menu;
use App\Models\Rating;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpCenter extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $menu = Menu::take(8)->get();
    $tickets = Ticket::all();

    $ratings = Rating::with('user')->get();

    $ticketCounts = [
      'pending' => $tickets->where('status', 3)->count(),
      'proses' => $tickets->whereBetween('status', [4, 7])->count(),
      'finish' => $tickets->where('status', '>', 7)->count(),
      'total' => $tickets->count(),
    ];

    return view('content.pages.front-pages.help-center-landing', [
      'pageConfigs' => $pageConfigs,
      'menus' => $menu,
      'title' => 'tiket',
      'tickets' => $tickets,
      'ticketCounts' => $ticketCounts,
      'ratings' => $ratings,
    ]);
  }
  public function tiket($tiket)
  {
    $tikets = Ticket::with('user', 'answer.status', 'statuses')->where('nomor_tiket', $tiket)->first();
    $tiketArray = '';
    if ($tikets) {
      $tiketArray = [
        'id' => $tikets->id ?? '',
        'judul' => $tikets->answer->judul ?? '',
        'nomor_tiket' => $tikets->nomor_tiket ?? '',
        'user' => $tikets->user ?? '',
        'status' => $tikets->statuses->name ?? '',
        'answer_status' => $tikets->answer->status->name ?? '',
      ];
    }

    return response()->json($tiketArray);
  }
}
