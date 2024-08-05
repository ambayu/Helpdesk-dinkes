<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Answer;
use App\Models\Bidang;
use App\Models\ResponAnswer;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Models\PermintaanUbahBidang as ModelsPermintaanUbahBidang;

class PermintaanUbahBidang extends Controller
{
  //
  public function index()
  {
    $menus = Menu::all();
    return view('content.apps.request-ubah-bidang', compact('menus'));
  }

  public function list()
  {
    $rub = ModelsPermintaanUbahBidang::with(['user', 'menu_rekomend', 'answer.ticket', 'menu_lama' => function ($query) {
      $query->withTrashed();
    }, 'menu_baru' => function ($query) {
      $query->withTrashed();
    }, 'user_validasi'])->orderBy('id', 'desc')
      ->get();

    $rubArray = $rub->map(function ($rub) {
      return [
        'id' => $rub->id,
        'rekomend_menu' => $rub->menu_rekomend->nama_layanan ?? '',
        'id_answer' => $rub->id_answer,
        'user_name' => $rub->user->name,
        'email_user' => $rub->user->email,
        'alasan' => $rub->alasan,
        'photo_profil' => $rub->user->profile_photo_path ?? '',
        'nama_layanan_lama' => $rub->menu_lama->nama_layanan ?? '',
        'nama_layanan_baru' => $rub->menu_baru->nama_layanan ?? '',
        'user_name_validasi' => $rub->user_validasi->name ?? '',
        'email_user_validasi' => $rub->user_validasi->email ?? '',
        'photo_profil_validasi' => $rub->user_validasi->profile_photo_path ?? '',
        'tanggal_kirim' => Carbon::parse($rub->created_at)->format('Y-m-d h:i') ?? '',
        'ticket' => $rub->answer?->ticket->nomor_tiket,
      ];
    });

    return response()->json(['data' => $rubArray]);
  }


  public function change(Request $request, ModelsPermintaanUbahBidang $pindahBidang)
  {
    $validatedData = $request->validate([
      'id_layanan_baru' => 'required|max:255',
    ]);

    $pindahBidang->id_user_validasi = auth()->user()->id;
    $pindahBidang->id_menu_baru = $validatedData['id_layanan_baru'];
    $pindahBidang->save();


    $ranswer = new ResponAnswer();
    $ranswer->id_answer = $pindahBidang->id_answer;
    $ranswer->id_user = auth()->user()->id;
    $ranswer->description = 'admin layanan diganti';

    $status_answer = '4';
    $answer = Answer::find($ranswer->id_answer);
    $answer->status_answer = $status_answer;
    $answer->id_pindah_layanan = $pindahBidang->id;
    $answer->save();
    $ranswer->save();

    return redirect()->route('app-layanan-permintaan-ubah-layanan.index')->with('success', 'Bidang Berhasil dipindahkan');
  }
}
