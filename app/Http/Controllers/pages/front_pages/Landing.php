<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Ticket;

class Landing extends Controller
{
  public function index()
  {
    $menu = Menu::all();
    $tickets = Ticket::all();

    $ratings = Rating::with('user')->where('status', 1)->get();
    $ticketCounts = [
      'pending' => $tickets->where('status', 3)->count(),
      'proses' => $tickets->whereBetween('status', [4, 7])->count(),
      'finish' => $tickets->where('status', '>', 7)->count(),
      'total' => $tickets->count(),
    ];


    $pageConfigs = ['myLayout' => 'front'];
    return view('content.pages.front-pages.landing-page', [
      'pageConfigs' => $pageConfigs,
      'menus' => $menu,
      'title' => 'home',
      'tickets' => $tickets,
      'ticketCounts' => $ticketCounts,
      'ratings' => $ratings,
    ]);
  }
}
