<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
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
        $usuario=User::findOrFail($request->input('idUsuario'));
        //$role = Role::findById($request->input('role'));

        //$usuario->syncRoles([$role]);
        $usuario->syncRoles($request->input('role'));
        return response()->json(['success' => "Asignacion de Roles Correcto"]);
    }
    public function cargarUserCheckbox(Request $request){
        $user=User::findOrFail($request->input('id'));
        $role=$user->getPermissionsViaRoles();
        return response()->json($role);
    }
}
