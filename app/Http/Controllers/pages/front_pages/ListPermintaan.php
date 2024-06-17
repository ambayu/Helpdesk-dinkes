<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ListPermintaan extends Controller
{
  //
  public function index()
  {
    return view('content.pages.pages-list-permintaan');
  }

  public function selesai()
  {
    return view('content.pages.pages-list-permintaan-selesai');
  }

  public function proses()
  {
    return view('content.pages.pages-list-permintaan-proses');
  }

  public function belum()
  {
    return view('content.pages.pages-list-permintaan-belum');
  }

  public function pergantian()
  {
    return view('content.pages.pages-pergantian-layanan');
  }

  public function permintaan()
  {
    return view('content.pages.pages-list-permintaan');
  }
}
