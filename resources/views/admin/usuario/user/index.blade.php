@extends('layout.maestra')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .error-message {
        color: red;
    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" id="btnModalUsuario">
                Registro de Usuarios
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalUsuario">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formUsuario" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <input type="text" id="opUsuario" name="opUsuario" value="I">
                                            <input type="text" id="idUsuario" name='idUsuario'>
                                            <label for="nombreUsuario" class="form-label">Nombre del Rol</label>
                                            <input class="form-control" type="text" id="nombreUsuario" name="nombreRol" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="nombreUsuarioError"></span>
                                        </div>
                                        <div class="mb-6">

                                            <label for="nombreUsuario" class="form-label">Correo del Usuario</label>
                                            <input class="form-control" type="text" id="correoUsuario" name="correoRol" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="correoUsuarioError"></span>
                                        </div>
                                        <div class="mb-6">
                                            {{-- <select name="role[]" class="form-control" id="" multiple>
                                                <option value="">Seleccionar Roles</option>
                                                @foreach ($role as $value)
                                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                                @endforeach
                                            </select> --}}

                                            @foreach ($role as $value )
                                            <div class="form-check form-switch">
                                                <input  type="checkbox" id="checkbox{{ $value->id }}" class="form-check-input checkbox" name="role[]" value="{{$value->name}}">
                                                {{$value->name}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnFornUsuario" metodo="I">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="tablaUsuario" class="listTablaUsuario display table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>






<!--termonio del modal-->
@endsection
@section('js')
<script src="{{asset('js/usuario/user.js')}}"></script>

<script>

    let cargarDatos="{{route('user.mostrar')}}";
    let guardarDatos="{{route('usuario.post')}}";
</script>

@endsection
