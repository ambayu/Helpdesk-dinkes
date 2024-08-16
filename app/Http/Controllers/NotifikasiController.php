<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
  //

  public function view(Notifikasi $notif)
  {
    $notif->status = 0;
    $notif->save();
    return redirect('/app/cek-permintaan/cari/' . $notif->nomor_tiket);
  }
}
