<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rating;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
  //
  public function index()
  {
    $ratings = Rating::with('user', 'answer', 'user_validasi')->orderBy('id', 'desc')->get();
    return view('content.apps.app-penilaian', compact('ratings'));
  }

  public function store(Request $request)
  {
    $rating = Rating::find($request->id);
    $rating->status = $request->status;
    $rating->id_user_validasi = auth()->user()->id;
    if ($rating->save()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false], 500);
    }
  }

  public function list()
  {
    $ratings = Rating::with('user', 'answer', 'user_validasi', 'answer.ticket')->orderBy('id', 'desc')->get();

    $ratingArray = $ratings->map(function ($rating) {
      return [
        'id' => $rating->id,
        'judul' => $rating->answer->judul, // Pastikan ini adalah field yang benar yang ingin Anda gunakan        'user' => $rating->user->id,
        'user' => $rating->user->name, // Pastikan ini adalah field yang benar yang ingin Anda gunakan        'user' => $rating->user->id,
        'user_email' => $rating->user->email,
        'user_poto' => $rating->user->profile_photo_path ?? '',
        'rating' => $rating->star,
        'deskripsi' => $rating->deskripsi,
        'status' => $rating->status,
        'ticket' => $rating->answer->ticket->nomor_tiket,
        'admin' => $rating->user_validasi->name ?? '',
        'admin_email' => $rating->user_validasi->email ?? '',
        'admin_poto' => $rating->user_validasi->profile_photo_path ?? '',

        'created_date' => Carbon::parse($rating->created_at->format('Y-m-d'))->format('Y-m-d h:i'),
      ];
    });


    return response()->json(['data' => $ratingArray]);
  }
}
