<?php

namespace App\Http\Controllers\Admin;
use App\Models\TipoOrganizacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizacionController extends Controller
{
    public function index(){
        $tipoOrganizacion=TipoOrganizacion::select('id','nombre')->where('estado',1)->get();
        return view('admin.organizacion.index',compact('tipoOrganizacion'));
    }
    public function cargarTabla(){
        $data=TipoOrganizacion::select('id','nombre')->where('estado',1)->get();
        return array("data" => $data);
    }
    public function GuardarOrganizacion(Request $request){
        //dd($request->$request->all());
        $validator = Validator::make($request->all(), [
            'nombreOrganizacion'=>'required',
            'direccionOrganizacion'=>'required',
            'selectTipoOrganizacion'=>'required|numeric',
            'fechaOrganizacion'=>'required',
            'numeroIntegrantes'=>'required|numeric'
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

}
