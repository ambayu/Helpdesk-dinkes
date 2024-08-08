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
      'average' => number_format($ratings->avg('star'), 2),
    ];
    $totalRatings = $ratings->count();

    $starCounts = [
      '1_star' => [
        'count' => $ratings->where('star', 1)->count(),
        'percentage' => $totalRatings > 0 ? ($ratings->where('star', 1)->count() / $totalRatings) * 100 : 0
      ],
      '2_star' => [
        'count' => $ratings->where('star', 2)->count(),
        'percentage' => $totalRatings > 0 ? ($ratings->where('star', 2)->count() / $totalRatings) * 100 : 0
      ],
      '3_star' => [
        'count' => $ratings->where('star', 3)->count(),
        'percentage' => $totalRatings > 0 ? ($ratings->where('star', 3)->count() / $totalRatings) * 100 : 0
      ],
      '4_star' => [
        'count' => $ratings->where('star', 4)->count(),
        'percentage' => $totalRatings > 0 ? ($ratings->where('star', 4)->count() / $totalRatings) * 100 : 0
      ],
      '5_star' => [
        'count' => $ratings->where('star', 5)->count(),
        'percentage' => $totalRatings > 0 ? ($ratings->where('star', 5)->count() / $totalRatings) * 100 : 0
      ],
    ];


    $pageConfigs = ['myLayout' => 'front'];
    return view('content.pages.front-pages.landing-page', [
      'pageConfigs' => $pageConfigs,
      'menus' => $menu,
      'title' => 'home',
      'tickets' => $tickets,
      'ticketCounts' => $ticketCounts,
      'ratings' => $ratings,
      'starCounts' => $starCounts,
      'totalRatings' => $totalRatings,
    ]);
  }
}
