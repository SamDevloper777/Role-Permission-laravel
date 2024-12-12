<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(5);
        return view('role.list', [
            'roles' => $roles
        ]);
    }
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('role.create', [
            'permissions' => $permissions

        ]);
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $haspermission = $role->permissions->pluck('name');
        $permissions=Permission::orderBy('name', 'ASC')->get();
        return view('role.edit',data: [
            'permissions' => $permissions,
            'haspermission' => $haspermission,
            'role'=>$role,
        ]); 
    }
    public function update($id,Request $request){

        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$id.',id',

        ]);

        if ($validator->passes()) {
            // $role = Role::create(['name' => $request->name]);

            $role->name=$request->name;
            $role->save();

            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);    
            }else{
                $role->syncPermissions([]);
            }
            return redirect()->route('roles.index')->with('success', 'Role Updated successfully');  // redirect to the users index page with success message

        } else {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }
        
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',

        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role added successfully');  // redirect to the users index page with success message
        } else {
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }
    }
    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
