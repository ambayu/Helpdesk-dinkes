<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpCenterArticle extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    return view('content.front-pages.help-center-article', ['pageConfigs' => $pageConfigs]);
  }
}
