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
            <button type="button" class="btn btn-primary" id="btnModalTipoOrganizacion">
                Crear Tipo de Organozación
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalTipoOrganizacion">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formTipoOrganiazion" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tipo de Organizacion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nombreTipoOrganizacion" class="form-label">Nombre del Tipo de la Organizacion</label>
                                    <input class="form-control" type="text" id="nombreTipoOrganizacion" placeholder="Escribir el Nombre" aria-label="default input example">
                                    <span class="error-message" id="nombreError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>nombre</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Comedor popular</td>
                        <td>
                            <button class="btn btn-small btn-primary">Editar</button>
                            <button class="btn btn-small btn-danger">Eliminar</button>
                        </td>

                    </tr>


                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>nombre</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
@section('js')
<script src="{{asset('js/admin/tipoOrganizacion.js')}}"></script>
<script>
    let guardarDatos="{{route('tipoOrganizacion.post')}}";
</script>
<script>
  var hola= new DataTable('#example');
</script>
@endsection
