<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpCenter extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];

    return view('content.pages.front-pages.help-center-landing', ['pageConfigs' => $pageConfigs]);
  }
}
