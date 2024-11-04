<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Rating;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaraPenggunaanController extends Controller
{

  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $menu = Menu::take(8)->get();
    $menus = Menu::all();


    return view('content.pages.front-pages.cara-penggunaan', [
      'pageConfigs' => $pageConfigs,
      'menus' => $menu,
      'title' => 'cara penggunaan',

      'menus_list' => $menus,
    ]);
  }
}
