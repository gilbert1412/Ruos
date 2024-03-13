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
            <button type="button" class="btn btn-primary" id="btnModalRol">
                Crear Rol
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalRol">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formRol" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Rol</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <input type="hidden" id="opRol" name="opRol" value="I">
                                            <input type="hidden" id="idRol" name='idRol'>
                                            <label for="nombreRol" class="form-label">Nombre del Rol</label>
                                            <input class="form-control" type="text" id="nombreRol" name="nombreRol" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="nombreRolError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnFornRol" metodo="I">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="tablaRol" class="listTablaRol display table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                        <th>Agregar Permisos</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                        <th>Agregar Permisos</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


<!-- Modal Permiso -->
<div class="modal fade" id="modalPermiso">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formRolPermiso">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignacion de Permisos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-6">
                                <input type="hidden" id="opRolPermiso" name="opRolPermiso" value="I">
                                <input type="" id="idRolPermiso" name='idRolPermiso'>
                                <label for="nombreRol" class="form-label">Nombre del Rol</label>
                                <input class="form-control" type="text"  id="nombreRolPermiso" name="nombreRolPermiso" placeholder="Escribir el Nombre" aria-label="default input example">

                                @foreach ($permiso as $key=> $values )
                                <div class="form-check form-switch">
                                    <input  type="checkbox" class="form-check-input" form="permiso" name="$permiso[{{$key}}]" value="{{$values->id}}">
                                    {{$values->name}}
                                  </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnFornRolPermiso" metodo="I">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--termonio del modal-->
@endsection
@section('js')
<script src="{{asset('js/usuario/rol.js')}}"></script>

<script>

    let cargarDatos="{{route('rol.mostrar')}}";
    let guardarDatos="{{route('rol.post')}}";
</script>

@endsection
