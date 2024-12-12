<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::orderBy('created_at','DESC')->paginate(5);
        return view('permission.list',[
            'permission' => $permissions    
        ]);
    }

    public function store(Request $request){
        $validator =Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3',
          
        ]); 

        if($validator->passes()){
                Permission::create(['name'=>$request->name]);
                return redirect()->route('permission.index')->with('success','Permission created successfully');  // redirect to the users index page with success message
        }
        else{
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }
    }
    public function create(){
        return view('permission.create');
    }
    public function edit($id){
        $permission =Permission::findOrFail($id);
        return view('permission.edit',[
            'permission' => $permission
        ]);
    }
    public function update(Request $request,$id){

        $permission =Permission::findOrFail($id);
        $validator =Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id',
          
        ]); 

        if($validator->passes()){
                // Permission::create(['name'=>$request->name]);
                $permission->name = $request->name;
                $permission->save();
                return redirect()->route('permission.index')->with('success','Permission Updated successfully');  // redirect to the users index page with success message
        }
        else{
            return redirect()->route('permission.edit',$id)->withInput()->withErrors($validator);
        }

    }
    public function destroy($id){
        $permission = Permission::find($id);

       
        $permission->delete();

        return redirect()->route('permission.index')->with('success','Permission deleted successfully');  // redirect to the users index page with success message
       
    }
}
