<?php

namespace App\Http\Controllers\apps;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\RoleBidang;
use Spatie\Permission\Models\Permission;

class ChangeBidang extends Controller
{
  public function index()
  {
    $bidangs = Bidang::all();
    return view('content.apps.change-bidang', compact('bidangs'));
  }

  public function list()
  {
    $bidang = RoleBidang::with('user')->with('bidang')->get();
    $bidangArray = $bidang->map(function ($bidang) {
      return [
        'id' => $bidang->id,
        'full_name' => $bidang->user->name,
        'username' => $bidang->user->username,
        'id_user' => $bidang->user->id,
        'id_bidang' => $bidang->id_bidang,

        "bidang" => $bidang->bidang->nama_bidang,
        "avatar" => $bidang->user->avatar,

        // 'created_date' => $user->created_at->format('Y-m-d')

      ];
    });

    return response()->json(['data' => $bidangArray]);
  }

  public function update(Request $request, RoleBidang $roleBidang)
  {
    $validatedData = $request->validate([
      'bidang' => 'required',

    ]);
    $roleBidang->update(['id_bidang' => $request->bidang]);
    return redirect()->route('app-bidang-ubah.index')->with('success', 'Bidang berhasil diganti.');
  }
}
