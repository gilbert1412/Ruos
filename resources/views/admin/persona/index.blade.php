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
                                        <input type="hidden" id="opPersona" name="opPersona"|>
                                        <input type="hidden" id="idPersona" name="idPersona">
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
                                        <select name="selectDirectivo" id="selectDirectivo" class="form-select">
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
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="tablaPersona" class="listTablaPersona display table table-primary" style="width:100%">
                <thead>
                    <tr>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Direccion</th>
                        <th>Celular</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                        <th  hidden></th>

                    </tr>
                </thead>
                <tbody>

                        @foreach ($data as $item)
                        <tr>
                            <th>{{$item->apePaterno}}</th>
                            <th>{{$item->apeMaterno}}</th>
                            <th>{{$item->nombre}}</th>
                            <th>{{$item->dni}}</th>
                            <th>{{$item->direccion}}</th>
                            <th>{{$item->celular}}</th>
                            <th>{{$item->nombreDirectivo}}</th>

                            <th>
                                <div class="btn-group">
                                    <button class="btn btn-info waves-effect waves-light"  metodo="U" idPersona=" {{$item->id}}">Editar</button>
                                    <button class="btn btn-danger waves-effect waves-light"  metodo="E" idPersona=" {{$item->id}}">Eliminar</button>
                                </div>
                            </th>
                            <th hidden>{{$item->directivosId}}</th>
                        </tr>
                        @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Direccion</th>
                        <th>Celular</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                        <th hidden></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
@section('js')
<script src="{{asset('js/admin/persona.js')}}"></script>
<script>
    let listarPersona="{{route('persona.get')}}";
    let guardarDatos="{{route('persona.post')}}";
</script>

@endsection
