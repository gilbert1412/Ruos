<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function index(){
        $role=Role::all();
        return view('admin.usuario.user.index',compact('role'));
    }
    public function cargarTabla(){
        $data=User::all();
        return array("data" => $data);
    }
    public function guardarUsuario(Request $request){
        $validator = Validator::make($request->all(), [
            'nombreUsuario'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'contraUsuario'=>['required', 'string', 'min:8'],
        ]);


        if($request->input('opUsuario')=='I'){
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()->toArray()]);
            }else{
                //dd($request->all());
                $user= User::create([
                    'name' => $request->input('nombreUsuario'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('contraUsuario')),
                ]);

                $user->syncRoles($request->input('role'));
                return response()->json(['success' => "Registro Guardado"]);
            }
        }else if($request->input('opUsuario')=='U'){

            // if($validator->fails()){
            //     return response()->json(['errors' => $validator->errors()->toArray()]);
            // }else{
            //     // dd($request->all());
            //     // User::where('id', $request->input('idUsuario'))
            //     // ->update(
            //     //     [
            //     //         'name' => $request->input('nombreUsuario'),
            //     //         'email' => $request->input('email'),
            //     //     ]
            //     // );

            // }
            $usuario=User::findOrFail($request->input('idUsuario'));
                $usuario->syncRoles($request->input('role'));
                return response()->json(['success' => "Registors Correctos"]);

        }

    }
    public function cargarUserCheckbox(Request $request){
        $user=User::findOrFail($request->input('id'));
        $role=$user->getPermissionsViaRoles();
        return response()->json($role);
    }
}
