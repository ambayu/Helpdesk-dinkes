<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Landing extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    return view('content.pages.front-pages.landing-page', ['pageConfigs' => $pageConfigs]);
  }
}
