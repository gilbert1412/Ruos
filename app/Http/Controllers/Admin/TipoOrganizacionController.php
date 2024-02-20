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
    public function GuardarTipoOrganizacion(Request $request){

        $validator = Validator::make($request->all(), [
            'nombre'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->toArray()]);
        }else{
            $data=TipoOrganizacion::create([
                'nombre'=>$request->nombre
            ]);
            return response()->json(['success' => 200]);

        }

    }
}
