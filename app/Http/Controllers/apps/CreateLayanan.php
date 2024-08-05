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
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class CreateLayanan extends Controller
{
  public function index()
  {

    $roles = Role::all();
    $permissions = Permission::all();

    return view('content.apps.create-layanan', compact('roles', 'permissions'));
  }

  public function list($slug)
  {

    $inputs = Menu::with('formulir.inputan')->where('slug', $slug)->first();

    return view('content.apps.create-layanan-list', compact('inputs'));
  }

  public function list_store(Request $request)
  {

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
    $tiket->id_user = auth()->user()->id;

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
      return redirect()->route('kirim-permintaan.list', ['slug' => $id_menu->menu->slug])->with('error', 'Tiket gagal dibuat');
    }

    return redirect()->route('kirim-permintaan.list', ['slug' => $id_menu->menu->slug])->with(
      [
        'success' => 'Permintaan berhasil disimpan.',
        'tiket' =>  $tiket->nomor_tiket
      ]
    );
  }

  public function store(Request $request)
  {

    $validatedData = $request->validate([
      'nama_layanan' => 'required|string|max:255|unique:menu,nama_layanan',


    ]);


    $menu = new Menu();
    $menu->nama_layanan = $request->nama_layanan;
    $menu->slug = str_replace(' ', '-', $request->nama_layanan);
    $menu->id_user = '1';

    if (isset($request->file)) {
      $menu->file = '1';
    } else {
      $menu->file = '0';
    }

    $menu->save();

    if (is_array($request->inputan) && !empty($request->inputan)) {

      foreach ($request->inputan as $input) {

        if ($input['name_label'] != null) {
          $formulir = new Formulir();
          $formulir->id_menu = $menu->id;
          $formulir->type_formulir = $input['input_type'];
          $formulir->formulir = $input['name_label'];
          $formulir->id_user = '1';
          $formulir->save();
        }
      }
    }


    return redirect()->route('create-layanan.index')->with('success', 'Layanan Telah Berhasil Dibuat');
  }

  public function update(Request $request, Permission $role)
  {
    $validatedData = $request->validate([
      'role_name' => 'required|unique:roles,name,' . $role->id . '|max:255',
      'permissions' => 'array'
    ]);

    $role->name = $validatedData['role_name'];
    $role->save();

    $role->syncPermissions($validatedData['permissions'] ?? []);

    return redirect()->route('app-access-permission.index')->with('success', 'Permissions updated successfully.');
  }
  public function destroy($id)
  {
    $user = User::find($id);
    if (!$user) {
      return response()->json(['error' => 'User not found.'], 404);
    }


    if ($user->delete()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false], 500);
    }
  }
}
