<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
class PermisoController extends Controller
{
    public function index(){
        return view('admin.usuario.permiso.index');
    }
    public function cargarTabla(){
        $data=Permission::all();
        return array("data" => $data);
    }
    public function guardarPermiso(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'nombrePermiso'=>'required'
        ]);
        if($request->input('opPermiso')=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                $permission = Permission::create(['name' => $request->input('nombrePermiso')]);
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->input('opPermiso')=='U'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                //dd($request->all());
                Permission::where('id', $request->input('idPermiso'))
                ->update(['name' => $request->input('nombrePermiso')]);
                return response()->json(['success' => "Registro Editado"]);
            }
        }
    }
}
