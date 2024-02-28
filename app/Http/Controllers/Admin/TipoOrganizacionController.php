<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoOrganizacion;
use App\Http\Requests\TipoOrganizacionRequest;
use Illuminate\Support\Facades\Validator;

class TipoOrganizacionController extends Controller
{
    public function index(){
        return view('admin.tipo_organizacion.index');
    }
    public function cargarTabla(){
        $data=TipoOrganizacion::select('id','nombre')->where('estado',1)->get();
        return array("data" => $data);
    }
    public function GuardarTipoOrganizacion(Request $request){
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'nombre'=>'required'
        ]);
        if($request->metodo=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{

                $data=TipoOrganizacion::create([
                     'nombre'=>$request->nombre
                ]);
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->metodo=='U'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                dd($request->all());
                TipoOrganizacion::where('id', $request->id)
                ->update(['nombre' => $request->nombre]);
                return response()->json(['success' => "Registro Editado"]);
            }
        }




    }
    public function actualizarTipoOrganizacion(){

    }
    public function eliminarTipoOrganizacion(){

    }
}
