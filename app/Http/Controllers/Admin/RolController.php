<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RolController extends Controller
{
    public function index(){
        $permiso=Permission::all();
        return view('admin.usuario.rol.index',compact('permiso'));
    }
    public function cargarTabla(){

        $data=Role::all();
        return array("data" => $data);
    }
    public function guardarRol(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'nombreRol'=>'required'
        ]);
        if($request->input('opRol')=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{

                $data = Role::create(['name' => $request->input('nombreRol')]);
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->input('opRol')=='U'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                //dd($request->all());
                Role::where('id', $request->input('idRol'))
                ->update(['name' => $request->input('nombreRol')]);
                return response()->json(['success' => "Registro Editado"]);
            }
        }else if($request->input('opRolPermiso')=='P'){
           //dd($request->all());

            $role=Role::findOrFail($request->input('idRolPermiso'));
            $role->syncPermissions($request->input('permiso'));
            return response()->json(
                [
                    'success' => "Asignacion de Permisos Correcto",

                ]
            );
        }
    }

    public function cargarCheckbox(Request $request){
       // dd($request->all());
        $role=Role::findById($request->input('id'));
        $permissions=$role->permissions;
        return response()->json(
            $permissions
        );

    }
}
