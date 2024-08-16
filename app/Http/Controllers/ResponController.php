<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Rating;
use App\Models\Ticket;
use App\Models\Notifikasi;
use App\Models\ResponAnswer;
use Illuminate\Http\Request;
use App\Models\PermintaanUbahBidang;
use Illuminate\Support\Facades\Auth;

class ResponController extends Controller
{

  public function penilaian(Request $request, Answer $answer)
  {
    $validatedData = $request->validate([
      'respon' => 'required|string',
      'star' => 'required|string',
    ]);



    $rating = new Rating();
    $rating->id_user = Auth::user()->id;
    $rating->id_answer = $answer->id;
    $rating->star = $validatedData['star'];
    $rating->deskripsi = $validatedData['respon'];
    $rating->save();

    $ticket = Ticket::find($answer->id_ticket);
    $ticket->status = '9';
    $ticket->save();

    $answer->status_answer = '9';
    $answer->save();

    return redirect()->back()->with('success', 'Terimakasih atas ulasan yang anda berikan');
  }

  public function pindah(Request $request, Answer $answer)
  {
    $user = Auth::user();

    $validatedData = $request->validate([
      'respon' => 'required|string',
      'ubah_bidang' => 'required|string',
    ]);

    if ($answer->status_answer == '5') {
      return redirect()->route('cek-permintaan.index')->with('error', 'Permintaan ubah layanan sudah pernah dikirim harap menunggu persetujuan admin');
      exit;
    }
    //ubah status tiket
    $ticket = Ticket::find($answer->id_ticket);
    $ticket->status = '2';
    $ticket->save();

    //simpan pindah ubah answer
    $pindah = new PermintaanUbahBidang();
    $pindah->id_answer = $answer->id;
    $pindah->id_user = $user->id;
    $pindah->id_rekomend_menu = $validatedData['ubah_bidang'];
    $pindah->id_menu_lama = $answer->id_menu;
    $pindah->alasan = $validatedData['respon'];
    $pindah->save();

    //ubah status answer
    $answer->status_answer = '5';
    $answer->save();

    return redirect()->route('cek-permintaan.index')->with('success', 'Permintaan Pindah Berhasil Terkirim');
  }


  public function selesai(Request $request, Answer $answer)
  {
    $validatedData = $request->validate([
      'respon' => 'required|string',
    ]);
    $user = Auth::user();
    $ticket = Ticket::find($answer->id_ticket);
    $ticket->status = '8';
    $ticket->save();

    $status_answer = '8';
    $answer->status_answer = $status_answer;
    $answer->save();

    $respon = new ResponAnswer();
    $respon->id_answer = $answer->id;
    $respon->id_user = $user->id;
    $respon->description = $validatedData['respon'];

    $respon->save();

    //notif
    $notif = new Notifikasi();
    $notif->nomor_tiket = $ticket->nomor_tiket;
    $notif->status = '1';
    $notif->judul = 'Permintaan  Selesai';
    $notif->deskripsi = 'Permintaan Telah Selesai Silahkan Berikan Feed-Back';
    $notif->id_user = $ticket->id_user;
    $notif->save();

    return redirect()->route('cek-permintaan.index')->with('success', 'Permintaan Selesai');
  }


  public function store(Request $request, Answer $answer)
  {
    $user = Auth::user();
    $ticket = Ticket::find($answer->id_ticket);
    $ticket->status = '2';


    $validatedData = $request->validate([
      'file' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
      'respon' => 'required|string',
    ]);

    $ticket->save();
    $path = null;
    $file = $request->file('file');
    if ($file) {
      $path = $file->store('responses/' . $ticket->nomor_tiket, 'public');
    }

    //jika admin yang mengirim
    $status_answer = '7';

    //jika user yang mengirim
    if ($ticket->id_user == $user->id) {
      $status_answer = '4';
    }

    $respon = new ResponAnswer();
    $respon->id_answer = $answer->id;
    $respon->id_user = $user->id;
    $respon->description = $validatedData['respon'];
    $respon->file = $path;
    $respon->save();

    $answer->status_answer =  $status_answer;

    $answer->save();

    if ($status_answer == '7') {
      //notifikasi status
      $notif = new Notifikasi();
      $notif->nomor_tiket = $ticket->nomor_tiket;
      $notif->status = '1';
      $notif->judul = 'Admin Telah Merespon Permintaan';
      $notif->deskripsi = 'Permintaan Telah Direspon Silahkan Melakukan Revisi';
      $notif->id_user = $ticket->id_user;
      $notif->save();
    }

    return redirect()->route('cek-permintaan.index')->with('success', 'Respon Berhasil Terkirim');
  }
}
