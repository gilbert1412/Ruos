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
            <button type="button" class="btn btn-primary" id="btnModalDirectivo">
                Crear Directivos
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalDirectivo">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formDirectivo" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tipo de Directivo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" id="opDirectivo" name="opDirectivo" value="I">
                                    <input type="hidden" id="idDirectivo" name='idDirectivo'>
                                    <label for="nombreDirectivo" class="form-label">Nombre Directivo</label>
                                    <input class="form-control" type="text" id="nombreDirectivo" name="nombreDirectivo" placeholder="Escribir el Nombre" aria-label="default input example">
                                    <span class="error-message" id="nombreDirectivoError"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnFormDirectivo" metodo="I">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <table id="tablaDirectivo" class="listTablaDirectivo display" style="width:100%">
                <thead>
                    <tr>

                        <th>nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>

                        <th>nombre</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
@section('js')
<script src="{{asset('js/admin/directivo.js')}}"></script>
<script>
    let guardarDatos="{{route('directivo.post')}}";
    let cargarDatos="{{route('directivo.mostrar')}}";
</script>

@endsection
