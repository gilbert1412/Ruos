<div class="modal fade" id="modalPersona">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPersonal" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Personal</h5>
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
