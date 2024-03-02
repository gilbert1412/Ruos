<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Directivo;
use Illuminate\Support\Facades\Validator;
class DirectivoController extends Controller
{
    public function index(){
        return view('admin.directivo.index');
    }
    public function cargarTabla(){
        $data=Directivo::select('id','nombre')->where('estado',1)->get();
        return array("data" => $data);
    }
    public function GuardarDirectivo(Request $request){
        //dd($request->$request->all());
        $validator = Validator::make($request->all(), [
            'nombreDirectivo'=>'required'
        ]);
        if($request->input('opDirectivo')=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{

                $data=Directivo::create([
                     'nombre'=>$request->input('nombreDirectivo')
                ]);
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->input('opDirectivo')=='U'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                //dd($request->all());
                Directivo::where('id', $request->input('idDirectivo'))
                ->update(['nombre' => $request->input('nombreDirectivo')]);
                return response()->json(['success' => "Registro Editado"]);
            }
        }else if($request->input('opDirectivo')=='E'){
            Directivo::where('id',$request->input('idDirectivo'))
            ->update(['estado'=>2]);
            return response()->json(['success'=>"Registro Eliminado Correctamente"]);
        }
    }
}
