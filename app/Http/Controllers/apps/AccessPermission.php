<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccessPermission extends Controller
{
  public function index()
  {
    $roles = Role::all();
    $permissions = Permission::all();

    return view('content.apps.app-access-permission', compact('roles', 'permissions'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'permission_name' => 'required|unique:permissions,name|max:255',

    ]);

    $create_permission = Permission::create(['name' => $request->permission_name]);

    return redirect()->route('app-access-permission.index')->with('success', 'Permissions created successfully.');
  }

  public function assigned(Request $request, Permission $permission)
  {
    // return $request;
    $validatedData = $request->validate([
      'permission_name' => 'required|max:255',
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
    $permission = Permission::find($id);
    if (!$permission) {
      return response()->json(['error' => 'Permission not found.'], 404);
    }

    $permission->delete();

    return response()->json(['success' => 'Permission deleted successfully.']);
  }


  public function permissionList()
  {
    $permissions = Permission::with('roles')->orderBy('name', 'ASC')->get();

    $permissionsArray = $permissions->map(function ($permission) {
      return [
        'id' => $permission->id,
        'name' => $permission->name,
        'assigned_to' => $permission->roles->pluck('name')->toArray(),
        'created_date' => $permission->created_at->format('Y-m-d')
      ];
    });

    return response()->json(['data' => $permissionsArray]);
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
}
