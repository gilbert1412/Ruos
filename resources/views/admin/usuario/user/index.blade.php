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
                                    <div class="col-md-6">
                                        <div class="mb-6">
                                            <input type="hidden" id="opUsuario" name="opUsuario" value="I">
                                            <input type="hidden" id="idUsuario" name='idUsuario'>
                                            <label for="nombreUsuario" class="form-label">Nombre del Rol</label>
                                            <input class="form-control"  type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="nombreUsuarioError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-6">
                                            <label for="correoUsuario" class="form-label">Correo del Usuario</label>
                                            <input class="form-control" type="email" id="email" name="email" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="emailError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-6">
                                            <label for="correoUsuario" id="labelContra" class="form-label">Contraseña del Usuario</label>
                                            <input class="form-control" type="password" id="contraUsuario" name="contraUsuario" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="contraUsuarioError"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        @foreach ($role as $value )
                                        <div class="form-check form-switch">
                                            <input  type="checkbox" id="checkbox{{ $value->id }}" class="form-check-input checkbox" name="role[]" value="{{$value->name}}">
                                            {{$value->name}}
                                        </div>
                                        @endforeach
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
            <table id="tablaUsuario" class="listTablaUsuario table text-nowrap mb-0 align-middle table table-sm" style="width:100%">
                <thead class="text-dark fs-4">
                    <tr class="border-bottom-0">
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nombre</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Correo</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Acciones</h6>
                        </th>

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
    let cargarCheckbox="{{route('checkboxUser.mostrar')}}";
</script>

@endsection
