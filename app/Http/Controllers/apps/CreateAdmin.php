<?php

namespace App\Http\Controllers\apps;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\RoleBidang;
use Spatie\Permission\Models\Permission;

class CreateAdmin extends Controller
{
  public function index()
  {
    $roles = Role::all();
    $permissions = Permission::all();
    $bidangs = Bidang::all();

    return view('content.apps.create-admin', compact('roles', 'permissions', 'bidangs'));
  }

  public function store(Request $request)
  {
    $validationRules = [
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users|max:255',
      'no_hp' => 'required|max:255',
      'username' => 'required|unique:users,username|max:255|min:6',
      'password' => 'required|string|min:6',
      'role' => 'required|integer',
      'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk foto
    ];
    // Simpan foto jika ada
    if ($request->hasFile('photo')) {
      $photoPath = $request->file('photo')->store('photos', 'public');
    } else {
      $photoPath = null;
    }

    // Tambahkan aturan validasi untuk bidang jika role adalah 4
    if ($request->role == 4) {
      $validationRules['bidang'] = 'required|integer|max:255';
    }
    $validatedData = $request->validate($validationRules);


    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->no_hp = $request->no_hp;
    $user->username = $request->username;
    $user->status = '2';
    $user->profile_photo_path = $photoPath;
    $user->password = bcrypt($request->password);

    if ($user->save()) {
      $nama_role = Role::findById($request->role);
      $user->assignRole($nama_role);

      if ($request->role == 4) {
        $role_bidang = new RoleBidang();
        $role_bidang->id_user = $user->id;
        $role_bidang->id_bidang = $request->bidang;
        $role_bidang->save();
      }
    }

    return redirect()->route('app-admin-tambah.index')->with('success', 'Admin created successfully.');
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
    $user = User::with('roleBidang.bidang')->get();
    // return User::with('roleBidang.bidang')->get();
    $userArray = $user->map(function ($user) {
      return [
        'id' => $user->id,
        'full_name' => $user->name,
        "role" =>  $user->getRoleNames()[0],
        "username" => $user->username,
        "email" => $user->email,
        "status" => $user->status,
        "avatar" => $user->profile_photo_path,
        "bidang" => $user->roleBidang->bidang['nama_bidang'] ?? '',

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

    $validationRules = [
      'role' => 'required|string|max:255',

    ];

    // Tambahkan aturan validasi untuk bidang jika role adalah 4
    if ($request->role == 'Admin Layanan') {
      $validationRules['bidang'] = 'required|max:255';
    }
    $validatedData = $request->validate($validationRules);



    // Pastikan role yang diminta valid
    $role = Role::where('name', $request->role)->first();
    if (!$role) {
      return response()->json(['success' => false, 'message' => 'Role not found'], 404);
    }


    $user->roles()->detach();

    // Assign role baru ke pengguna
    if ($user->assignRole($role)) {

      //ubah bidang
      if ($request->role == 'Admin Layanan') {
        $role_bidang = RoleBidang::where('id_user', $user->id)->first();
        if (!$role_bidang) {
          $role_bidang = new RoleBidang();
          $role_bidang->id_user = $user->id;
        }
        $role_bidang->id_bidang = $request->bidang;
        $role_bidang->save();
      } else {
        RoleBidang::where('id_user', $user->id)->delete();
      }
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
