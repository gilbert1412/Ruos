<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function GuardarPersona(Request $request){
        //dd($request->$request->all());
        $validator = Validator::make($request->all(), [
            'apeMaterno'=>'required',
            'apePaterno'=>'required',
            'nombre'=>'required',
            'dni'=>'required',
            'direccion'=>'required',
            'celular'=>'required',
            'selectDirectivo'=>'required',
        ]);
        if($request->input('opPersona')=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{

                $data=TipoOrganizacion::create([
                     'nombre'=>$request->input('nombreTipoOrganizacion'),
                     'apePaterno'=>$request->input('apeMaterno'),
                     'apeMaterno'=>  $request->input('apePaterno'),
                     'nombre'=>$request->input('nombre'),
                     'dni'=>$request->input('dni'),
                     'direccion'=>$request->input('direccion'),
                     'celualr'=>$request->input('celular'),
                     'directivo_id'=>$request->input('selectDirectivo'),
                     'organizacion_id'=>$request->input('idOrganizacionPersona')


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
