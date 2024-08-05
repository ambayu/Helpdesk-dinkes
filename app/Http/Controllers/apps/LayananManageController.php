<?php

namespace App\Http\Controllers\apps;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\User;
use App\Models\Answer;
use App\Models\Bidang;
use App\Models\Ticket;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Syarat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class LayananManageController extends Controller
{
  public function index()
  {

    $menus = Menu::with('user')->with('formulir')->get();

    return view('content.apps.manage-layanan', compact('menus'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'syarat' => 'required|string',
      'id' => 'required|string',
      'bantuan' => 'required|string',
    ]);

    $lihat_syarat = Syarat::find($request->id);
    if ($lihat_syarat) {
      $lihat_syarat->syarat = $validatedData['syarat'];
      $lihat_syarat->id_menu = $validatedData['id'];
      $lihat_syarat->cara_penggunaan = $validatedData['bantuan'];
      $lihat_syarat->save();
    } else {
      $syarat = new Syarat();
      $syarat->syarat = $validatedData['syarat'];
      $syarat->id_menu = $validatedData['id'];
      $syarat->cara_penggunaan = $validatedData['bantuan'];
      $syarat->save();
    }

    return response()->json(['message' => 'Data syarat dan bantuan berhasil disimpan'], 200);
  }


  public function syarat()
  {

    $menus = Menu::with('user', 'formulir', 'syarat')->get();


    return view('content.apps.syarat-layanan', compact('menus'));
  }

  public function list_syarat()
  {

    $menus = Menu::with('user', 'formulir', 'syarat')->get();


    return response()->json(['data' => $menus]);
  }

  public function list_syarat_cari(Menu $menu)
  {
    $syarat = Syarat::where('id_menu', $menu->id)->first();


    return response()->json($syarat);
  }

  public function update(Request $request, Menu $menu)
  {


    $validatedData = $request->validate([
      'nama_layanan' => 'required|string|max:255',
    ]);

    $cek = Menu::where('nama_layanan', $request->nama_layanan)->first();
    if ($cek && $request->nama_layanan != $menu->nama_layanan) {

      return redirect()->route('app-layanan-kelola.index')->with('error', 'Nama layanan sudah ada');
    }
    $menu->nama_layanan = $request->nama_layanan;
    $menu->slug = str_replace(' ', '-', $request->nama_layanan);
    $menu->id_user = Auth::user()->id;

    if (isset($request->file)) {
      $menu->file = '1';
    } else {
      $menu->file = '0';
    }

    $menu->save();
    //delete semua formulir terdahulu

    Formulir::where('id_menu', $menu->id)->delete();

    if (is_array($request->inputan) && !empty($request->inputan)) {

      foreach ($request->inputan as $input) {

        //jika nama label tidak ada maka input tidak dimasukkan
        if ($input['name_label'] != null) {
          $formulir = new Formulir();
          $formulir->id_menu = $menu->id;
          $formulir->type_formulir = $input['input_type'];
          $formulir->formulir = $input['name_label'];
          $formulir->id_user = Auth::user()->id;
          $formulir->save();
        }
      }
    }


    return redirect()->route('app-layanan-kelola.index')->with('success', 'Layanan Telah Berhasil Diperbarui');
  }



  public function list()
  {

    $menu = Menu::with('user')->with('formulir')->get();

    return response()->json(['data' => $menu]);
  }

  public function destroy(Menu $menu)
  {
    $formulir = Formulir::where('id_menu', $menu->id)->first();
    if ($formulir) {
      $formulir->delete();
    }
    $menu->delete();
    return response()->json(['success' => true]);
  }
}
