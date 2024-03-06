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
            <button type="button" class="btn btn-primary" id="btnModalOrganizacion">
                Crear Organozación
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalOrganizacion">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formOrganizacion" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Organizacion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <input type="hidden" id="opOrganizacion" name="opOrganizacion" value="I">
                                            <input type="hidden" id="idOrganizacion" name='idOrganizacion'>
                                            <label for="nombreOrganizacion" class="form-label">Nombre de la Organizacion</label>
                                            <input class="form-control" type="text" id="nombreOrganizacion" name="nombreOrganizacion" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="nombreOrganizacionError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-6">
                                            <label for="direccionOrganizacion" class="form-label">Dirección de la Organizacion</label>
                                            <input class="form-control" type="text" id="direccionOrganizacion" name="direccionOrganizacion" placeholder="Escribir el Nombre" aria-label="default input example">
                                            <span class="error-message" id="direccionOrganizacionError"></span>
                                        </div>
                                    </div>
                                    <!---->
                                    <div class="col-md-6">
                                        <div class="mb-6">

                                            <label for="selectTipoOrganizacion" class="form-label">Tipo de Organizacion</label>
                                            <select name="selectTipoOrganizacion" id="selectTipoOrganizacion" class="form-control">
                                                <option value="" hidden>Seleccione</option>
                                                @foreach ( $tipoOrganizacion as $values )
                                                    <option value={{$values->id}}>{{$values->nombre}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message" id="selectTipoOrganizacionError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-6">
                                            <label for="fechaOrganizacion" class="form-label">fecha de Inicio</label>
                                            <input type="date" name="fechaOrganizacion" id="fechaOrganizacion" class="form-control">
                                            <span class="error-message" id="fechaOrganizacionError"></span>
                                        </div>
                                    </div>

                                    <!---->
                                    <div class="col-md-6">
                                        <div class="mb-6">
                                            <label for="numeroIntegrantes" class="form-label">Numero de Integrantes</label>
                                            <input type="number" name="numeroIntegrantes" id="numeroIntegrantes" class="form-control">
                                            <span class="error-message" id="numeroIntegrantesError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <label for="descripcionOrganizacion" class="form-label">Descripcion</label>
                                            <textarea name="descripcionOrganizacion" id="descripcionOrganizacion" class="form-control"  rows="5"></textarea>
                                            <span class="error-message" id="descripcionOrganizacionError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnFormOrganizacion" metodo="I">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="tablaOrganizacion" class="listTablaOrganizacion display text-align-center" style="width:100%">
                <thead>
                    <tr>

                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Fecha de Creación</th>
                        <th>Numero de Miembros</th>
                        <th>Tipo de Organizacion</th>
                        <th>Acciones</th>
                        <th>Añadir Miembros</th>
                        <th>Ver Miembros</th>

                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Fecha de Creación</th>
                        <th>Numero de Miembros</th>
                        <th>Tipo de Organizacion</th>
                        <th>Acciones</th>
                        <th>Añadir Miembros</th>
                        <th>Ver Miembros</th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<!--modal personmal-->
<div class="modal fade" id="modalPersona">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPersonal" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Miembros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-6">
                                <input type="hidden" id="opOrganizacionPersona" name="opOrganizacionPersona"|>
                                <input type="hidden" id="idOrganizacionPersona" name="idOrganizacionPersona">
                                <label for="apePaterno" class="form-label">Apellido Paterno</label>
                                <input class="form-control" type="text" id="apePaterno" name="apePaterno" placeholder="Escribir el Nombre" aria-label="default input example">
                                <span class="error-message" id="apePaternoError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="apeMaterno" class="form-label">Apellido Materno</label>
                                <input class="form-control" type="text" id="apeMaterno" name="apeMaterno" placeholder="Escribir el Nombre" aria-label="default input example">
                                <span class="error-message" id="apeMaternoError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribir el Nombre" aria-label="default input example">
                                <span class="error-message" id="nombreError"></span>
                            </div>
                        </div>
                        <!---->
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="number" name="dni" id="dni" class="form-control">
                                <span class="error-message" id="dniError"></span>
                            </div>
                        </div>
                        <!---->
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="direccion" class="form-label">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
                                <span class="error-message" id="direccionError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="number" name="celular" id="celular" class="form-control">
                                <span class="error-message" id="celularError"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-6">
                                <label for="selectDirectivo" class="form-label">CARGO</label>
                                <select name="selectDirectivo" id="selectDirectivo" class="form-control">
                                    <option value="" hidden>Seleccione</option>
                                    @foreach ($directivo as $value )
                                        <option value="{{$value->id}}">{{$value->nombre}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message" id="selectDirectivoError"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnFormPersona" metodo="I">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!--termonio del modal-->
@endsection
@section('js')
<script src="{{asset('js/admin/organizacion.js')}}"></script>

<script>
    let guardarDatos="{{route('organizacion.post')}}";
    let cargarDatos="{{route('organizacion.mostrar')}}";
    let mostrarPersona="{{route('persona')}}";
</script>

@endsection
