<?php

namespace App\Http\Controllers\Admin;
use App\Models\TipoOrganizacion;
use App\Models\Organizacion;
use App\Models\Directivo;
use App\Models\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class OrganizacionController extends Controller
{

    public function index(){
        $tipoOrganizacion=TipoOrganizacion::select('id','nombre')->where('estado',1)->get();
        $directivo=Directivo::select('id','nombre')->where('estado',1)->get();
        return view('admin.organizacion.index',compact('tipoOrganizacion','directivo'));
    }
    public function cargarTabla(){
        $data=DB::table('organizacion')
        ->join('tipo_organizacion','organizacion.tipo_organizacion_id','=','tipo_organizacion.id')
        ->select('organizacion.*','tipo_organizacion.nombre as tipoOrganizacionNombre', 'tipo_organizacion.id as tipoOrganizacionId')
        ->where('organizacion.estado',1)
        ->get();
        //dd($data);
        //$data=Organizacion::select('id','nombre','direccion','fecha_inicio','numero_integrantes')->where('estado',1)->get();
        return array("data" => $data);
    }
    public function GuardarOrganizacion(Request $request){

        if($request->input('opOrganizacion')=='I' ||$request->input('opOrganizacion')=='U'){
            $validator = Validator::make($request->all(), [
                'nombreOrganizacion'=>'required',
                'direccionOrganizacion'=>'required',
                'selectTipoOrganizacion'=>'required|numeric',
                'fechaOrganizacion'=>'required',
                'numeroIntegrantes'=>'required|numeric'
            ]);
        }else if($request->input('opOrganizacionPersona')=='A'){
            $validatorPersona = Validator::make($request->all(), [
                'apeMaterno'=>'required',
                'apePaterno'=>'required',
                'nombre'=>'required',
                'dni'=>'required',
                'direccion'=>'required',
                'celular'=>'required',
                'selectDirectivo'=>'required',
            ]);
        }
        if($request->input('opOrganizacion')=='I' ){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                $data=Organizacion::create([
                     'nombre'=>$request->input('nombreOrganizacion'),
                     'direccion'=>$request->input('direccionOrganizacion'),
                     'tipo_organizacion_id'=>$request->input('selectTipoOrganizacion'),
                     'fecha_inicio'=>$request->input('fechaOrganizacion'),
                     'numero_integrantes'=>$request->input('numeroIntegrantes'),
                     'descripcion'=>$request->input('descripcionOrganizacion'),
                ]);
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->input('opOrganizacion')=='U'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                //dd($request->all());
                Organizacion::where('id', $request->input('idOrganizacion'))
                ->update([
                    'nombre'=>$request->input('nombreOrganizacion'),
                    'direccion'=>$request->input('direccionOrganizacion'),
                    'tipo_organizacion_id'=>$request->input('selectTipoOrganizacion'),
                    'fecha_inicio'=>$request->input('fechaOrganizacion'),
                    'numero_integrantes'=>$request->input('numeroIntegrantes'),
                    'descripcion'=>$request->input('descripcionOrganizacion'),
                ]);
                return response()->json(['success' => "Registro Editado"]);
            }
        }else if($request->input('opOrganizacion')=='E'){
            //dd($request->all());
            Organizacion::where('id',$request->input('idOrganizacion'))
            ->update(['estado'=>2]);
            return response()->json(['success'=>"Registro Eliminado Correctamente"]);
        }
        if($request->input('opOrganizacionPersona')=='A'){
            //dd($request->all());
            if($validatorPersona->fails()){
                return response()->json(['errors' => $validatorPersona->errors()->toArray()]);
            }else{
                $data=Persona::create([
                    'nombre'=>$request->input('nombreTipoOrganizacion'),
                    'apePaterno'=>$request->input('apeMaterno'),
                    'apeMaterno'=>  $request->input('apePaterno'),
                    'nombre'=>$request->input('nombre'),
                    'dni'=>$request->input('dni'),
                    'direccion'=>$request->input('direccion'),
                    'celular'=>$request->input('celular'),
                    'directivo_id'=>$request->input('selectDirectivo'),
                    'organizacion_id'=>$request->input('idOrganizacionPersona')
               ]);
               return response()->json(['success' => "Registro Guardado"]);
            }
        }
    }

    public function verPersona(){
        $directivo=Directivo::select('id','nombre')->where('estado',1)->get();
        $data= DB::table('persona')
        ->join('directivos','persona.directivo_id','=','directivos.id')
        ->select('persona.*','directivos.nombre as nombreDirectivo', 'directivos.id as directivosId')
        ->where('persona.organizacion_id','=',request('id'))
        ->where('persona.estado',1)
        ->get();
        return view('admin.persona.index',compact('data','directivo'));
    }

    public function cargarListaPersona(){

        $data=DB::table('persona')
        ->where('estado',1)
        ->get();

        DB::table('persona')
        ->join('directivos','persona.directivo.id','=','directivos.id')
        ->select('persona.*','directivos.nombre as nombreDirectivo')
        ->where('persona.estado',1)
        ->get();






       return (array("data"=>$data));
    }
}
