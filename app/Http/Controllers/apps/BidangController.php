<?php

namespace App\Http\Controllers\apps;

use App\Models\Menu;
use App\Models\User;
use App\Models\Answer;
use App\Models\Ticket;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\MenuBidang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
  public function index()
  {

    $menus = Menu::all();


    return view('content.apps.create-bidang', compact('menus'));
  }




  public function store(Request $request)
  {

    $validatedData = $request->validate([
      'nama_bidang' => 'required|string|max:255|unique:bidang,nama_bidang',


    ]);


    $bidang = new Bidang();
    $bidang->nama_bidang = $request->nama_bidang;


    if ($bidang->save()) {
      return redirect()->route('app-bidang-tambah.index')->with('success', 'Bidang Telah Berhasil Dibuat');
    } else {
      return redirect()->route('app-bidang-tambah.index')->with('error', 'Erro Bidang Tida Telah Berhasil Dibuat');
    }
  }
  public function list()
  {
    $bidang = Bidang::with('menuBidang.menu')->get();

    $bidangArray = $bidang->map(function ($bidang) {
      return [
        'id' => $bidang->id,
        'nama_bidang' => $bidang->nama_bidang,
        'menu_bidang' => $bidang->menuBidang->map(function ($menuBidang) {
          return $menuBidang->menu ? $menuBidang->menu->nama_layanan : null;
        })->filter()->unique()->values()->toArray(),
        'created_at' => Carbon::parse($bidang->created_at)->format('Y-m-d'),
      ];
    });

    return response()->json(['data' => $bidangArray]);
  }

  public function cari_list($bidang)
  {

    $bidang = Bidang::where('id', $bidang)->with('menuBidang.menu')->get();

    $bidangArray = $bidang->map(function ($bidang) {
      return [
        'id' => $bidang->id,
        'nama_bidang' => $bidang->nama_bidang,
        'menu_bidang' => $bidang->menuBidang->map(function ($menuBidang) {
          return $menuBidang->menu ? $menuBidang->menu->nama_layanan : null;
        })->filter()->unique()->values()->toArray(),
        'id_bidang' => $bidang->menuBidang->map(function ($menuBidang) {
          return $menuBidang->menu ? $menuBidang->menu->id : null;
        })->filter()->unique()->values()->toArray(),
        'created_at' => Carbon::parse($bidang->created_at)->format('Y-m-d'),
      ];
    });

    return response()->json($bidangArray[0]);
  }

  public function update(Request $request, Bidang $bidang)
  {
    $validatedData = $request->validate([
      'nama_bidang' => 'required|max:255',

    ]);


    $cek = Bidang::where('nama_bidang', $request->nama_bidang)->first();

    if ($cek && $request->nama_bidang != $bidang->nama_bidang) {

      return redirect()->route('app-bidang-tambah.index')->with('error', 'Nama bidang sudah ada');
    }


    $bidang->nama_bidang = $validatedData['nama_bidang'];
    $bidang->save();

    MenuBidang::where('id_bidang', $bidang->id)->delete();

    if (is_array($request->menu) && !empty($request->menu)) {

      foreach ($request->menu as $menu) {

        $menub = new MenuBidang();
        $menub->id_bidang = $bidang->id;
        $menub->id_menu = $menu;
        $menub->save();
      }
    }

    return redirect()->route('app-bidang-tambah.index')->with('success', 'Bidang berhasil diperbarui.');
  }
  public function destroy(Bidang $bidang)
  {

    if (!$bidang) {

      return response()->json(['error' => 'Bidang tidak ditemukan.'], 404);
    }


    if ($bidang->delete()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false], 500);
    }
  }
}
