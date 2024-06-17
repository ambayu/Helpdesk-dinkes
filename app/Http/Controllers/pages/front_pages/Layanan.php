<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class Layanan extends Controller
{
  //
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.pages.layanan.cara', ['pageConfigs' => $pageConfigs]);
  }
}
