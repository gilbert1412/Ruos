<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
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
        }
    }
}
