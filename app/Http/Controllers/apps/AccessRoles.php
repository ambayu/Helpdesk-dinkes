<?php

namespace App\Http\Controllers\apps;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Spatie\Permission\Models\Permission;

class AccessRoles extends Controller
{

  public function index()
  {
    $bidangs = Bidang::all();
    $roles = Role::withCount('users')->with('users')->get();
    // return $roles;
    $permissions = Permission::all();
    return view('content.apps.app-access-roles', compact('roles', 'permissions', 'bidangs'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'role_name' => 'required|unique:roles,name|max:255',
    ]);

    Role::create(['name' => $request->role_name]);


    return redirect()->route('app-access-roles.index')->with('success', 'Role created successfully.');
  }

  public function update(Request $request, Role $role)
  {
    $validatedData = $request->validate([
      'role_name' => 'required|unique:roles,name,' . $role->id . '|max:255',
      'permissions' => 'array'
    ]);

    $role->name = $validatedData['role_name'];
    $role->save();

    $role->syncPermissions($validatedData['permissions'] ?? []);

    return redirect()->route('app-access-roles.index')->with('success', 'Role updated successfully.');
  }
  public function destroy(Role $role)
  {
    $role->delete();

    return redirect()->route('app-access-roles.index')->with('success', 'Role deleted successfully.');
  }
}
