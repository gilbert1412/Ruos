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
            <button type="button" class="btn btn-primary" id="btnModalPermiso">
                Crear Permiso
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalPermiso">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formPermiso" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Permiso</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <input type="hidden" id="opPermiso" name="opPermiso" value="I">
                                            <input type="" id="idPermiso" name='idPermiso'>
                                            <label for="nombrePermiso" class="form-label">Asignar Permiso</label>
                                            <input class="form-control" type="text" id="nombrePermiso" name="nombrePermiso" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="nombreRolErPermiso"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnFornPermiso" metodo="I">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="tablaPermiso" class="listTablaPermiso display table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


<!--termonio del modal-->
@endsection
@section('js')
<script src="{{asset('js/usuario/permiso.js')}}"></script>

<script>
    let cargarDatos="{{route('permiso.mostrar')}}";
    let guardarDatos="{{route('permiso.post')}}";
</script>

@endsection
