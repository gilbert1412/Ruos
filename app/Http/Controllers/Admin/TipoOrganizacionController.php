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
        //dd($request->$request->all());
        $validator = Validator::make($request->all(), [
            'nombreTipoOrganizacion'=>'required'
        ]);
        if($request->input('opTipoOrganizacion')=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{

                $data=TipoOrganizacion::create([
                     'nombre'=>$request->input('nombreTipoOrganizacion')
                ]);
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->input('opTipoOrganizacion')=='U'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                //dd($request->all());
                TipoOrganizacion::where('id', $request->input('idTipoOrganizacion'))
                ->update(['nombre' => $request->input('nombreTipoOrganizacion')]);
                return response()->json(['success' => "Registro Editado"]);
            }
        }else if($request->input('opTipoOrganizacion')=='E'){
            TipoOrganizacion::where('id',$request->input('idTipoOrganizacion'))
            ->update(['estado'=>2]);
            return response()->json(['success'=>"Registro Eliminado Correctamente"]);
        }




    }
    public function actualizarTipoOrganizacion(){

    }
    public function eliminarTipoOrganizacion(){

    }
}
