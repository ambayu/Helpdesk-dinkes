<?php

namespace App\Http\Controllers\pages\front_pages;

use App\Models\Menu;

use App\Models\Answer;
use App\Models\Ticket;
use App\Models\Inputan;
use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Validator;

class Layanan extends Controller
{
  //
  public function index($slug, Request $request)
  {
    //sementara langsung redirect ke login dulu
    return redirect()->route('auth-login-masuk-sso');

    $menu = Menu::with('formulir.inputan')->where('slug', $slug)->first();


    $pageConfigs = ['myLayout' => 'blank'];
    return view(
      'content.pages.layanan.kirim-permintaan',
      [
        'pageConfigs' => $pageConfigs,
        'inputs' => $menu,
      ]
    );
  }

  public function syarat_layanan($slug)
  {

    $menu = Menu::with('syarat')->where('slug', $slug)->first();
    // return $menu;

    $pageConfigs = ['myLayout' => 'blank'];
    return view(
      'content.pages.layanan.syarat-permintaan',
      [
        'pageConfigs' => $pageConfigs,
        'menu' => $menu,
      ]
    );
  }

  public function bantuan_layanan($slug)
  {

    $menu = Menu::with('syarat')->where('slug', $slug)->first();
    // return $menu;

    $pageConfigs = ['myLayout' => 'blank'];
    return view(
      'content.pages.layanan.bantuan-permintaan',
      [
        'pageConfigs' => $pageConfigs,
        'menu' => $menu,
      ]
    );
  }

  public function store(Request $request)
  {

    //sementara langsung redirect ke login dulu
    return redirect()->route('auth-login-masuk-sso');


    // Validasi data dari $request
    $validator = Validator::make(
      $request->all(),
      [
        'judul' => 'required|string|max:255', // Contoh validasi untuk email-username
        'type.*.id_formulir' => 'required|integer', // Validasi untuk semua id_formulir dalam array type
        'type.*.respon' => 'required|string', // Validasi untuk semua respon dalam array type      'file' => 'nullable|file|max:2048', // Contoh validasi untuk file (opsional, maksimum 2MB)
      ],
      [
        'type.*.id_formulir.required' => 'Id formulir pada elemen diatas harus diisi.',
        'type.*.respon.required' => 'Respon pada colom ini harus diisi.',
      ]
    );

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }
    $nomor_tiket = 'T' . now()->format('Ymdhis') . rand(1, 9);
    $id_menu = Formulir::with('menu')->where('id', $request->type[0]['id_formulir'])->first();

    $tiket = new Ticket;
    $tiket->nomor_tiket = $nomor_tiket;
    $tiket->id_user = '4';  // cari id_user dari login

    if ($tiket->save()) {
      $answer = new Answer();
      $answer->id_menu = $id_menu->id_menu;
      $answer->judul = $request->judul;
      $answer->id_ticket = $tiket->id;
      $answer->tanggal_kirim = now();
      $answer->deskripsi = $request->deskripsi;

      $formulirData = [];
      foreach ($request->type as $data) {
        $id_formulir = $data['id_formulir'];
        $respon = $data['respon'];
        $formulirData[] = [
          'id_formulir' => $id_formulir,
          'respon' => $respon,
        ];
      }
      $answer->status_answer = '0';
      $answer->formulir = $formulirData;

      // Jika ada file yang diunggah, simpan file ke server
      if ($request->hasFile('file')) {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = $nomor_tiket . '.' . $extension;
        $filePath = $file->storeAs('public/assets/file', $filename);
        $answer->file = $filePath;
      }

      $answer->save();
    } else {
      return redirect()->route('layanan.index', ['slug' => $id_menu->menu->slug])->with('error', 'Tiket gagal dibuat');
    }

    return redirect()->route('layanan.index', ['slug' => $id_menu->menu->slug])->with(
      [
        'success' => 'Permintaan berhasil disimpan.',
        'tiket' =>  $tiket->nomor_tiket
      ]
    );
  }
}
