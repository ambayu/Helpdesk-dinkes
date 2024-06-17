<?php

namespace App\Http\Controllers\apps;

use App\Models\Menu;
use App\Models\User;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class CreateLayanan extends Controller
{
  public function index()
  {
    $roles = Role::all();
    $permissions = Permission::all();

    return view('content.apps.create-layanan', compact('roles', 'permissions'));
  }

  public function store(Request $request)
  {

    $validatedData = $request->validate([
      'nama_layanan' => 'required|string|max:255|unique:menu,nama_layanan',
      'slug' => 'required|string|max:255',

    ]);

    $menu = new Menu();
    $menu->nama_layanan = $request->nama_layanan;
    $menu->slug = $request->slug;
    $menu->id_user = '1';

    if (isset($request->file)) {
      $menu->file = '1';
    } else {
      $menu->file = '0';
    }

    $menu->save();

    if (is_array($request->inputan) && !empty($request->inputan)) {
      foreach ($request->inputan as $input) {
        $formulir = new Formulir();
        $formulir->id_menu = $menu->id;
        $formulir->type_formulir = $input['input_type'];
        $formulir->formulir = $input['name_label'];
        $formulir->id_user = '1';
        $formulir->save();
      }
    } else {
    }


    return redirect()->route('create-layanan.index')->with('success', 'Layanan Telah Berhasil Dibuat');
  }

  public function assigned(Request $request, Permission $permission)
  {
    $validatedData = $request->validate([
      'permission_name' => 'required|unique:permissions,name|max:255',
      'assigments' => 'required|array',
    ]);

    $permission->update(['name' => $request->permission_name]);

    $permissions = $permission->name;


    $permission->roles()->sync([]);

    foreach ($request->assigments as $assigment) {


      $role = Role::findByName($assigment); // Ambil role berdasarkan Nama

      // Periksa apakah role ditemukan
      if ($role) {
        $role->givePermissionTo($permissions); // Berikan izin ke role
      }
    }



    return redirect()->route('app-access-permission.index')->with('success', 'Permissions created successfully.');
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


  public function adminList()
  {
    $user = User::all();

    $userArray = $user->map(function ($user) {
      return [
        'id' => $user->id,
        'full_name' => $user->name,
        "role" =>  $user->getRoleNames()[0],
        "username" => $user->username,
        "email" => $user->email,
        "status" => $user->status,
        "avatar" => "",

        // 'created_date' => $user->created_at->format('Y-m-d')

      ];
    });

    return response()->json(['data' => $userArray]);
  }

  public function getpermissionList(Permission $permission)
  {
    $permissions = Permission::with('roles')->where('id', $permission->id)->get();

    $permissionsArray = $permissions->map(function ($permission) {
      return [
        'id' => $permission->id,
        'name' => $permission->name,
        'assigned_to' => $permission->roles->pluck('name')->toArray(),
        'created_date' => $permission->created_at->format('Y-m-d')
      ];
    });

    return response()->json($permissionsArray[0]);
  }

  public function changeRole(Request $request, User $user)
  {
    $request->validate([
      'role' => 'required',
    ]);

    // Pastikan role yang diminta valid
    $role = Role::where('name', $request->role)->first();
    if (!$role) {
      return response()->json(['success' => false, 'message' => 'Role not found'], 404);
    }


    $user->roles()->detach();

    // Assign role baru ke pengguna
    if ($user->assignRole($role)) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false, 'message' => 'Failed to assign role'], 500);
    }
  }

  public function updateStatus(Request $request)
  {
    $request->validate([
      'id' => 'required|integer|exists:users,id',
      'status' => 'required|boolean',
    ]);

    $user = User::find($request->id);
    $user->status = $request->status;

    if ($user->save()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false], 500);
    }
  }
}
