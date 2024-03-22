

$(document).ready(function () {
    var tablaOrganizacion;
    cargarTabla();
    cargarModal();
    editarOrganizacion();
    GuardarOrganizacion();
    guardarPersona();
});
function cargarTabla() {
    tablaOrganizacion = $('#tablaOrganizacion').DataTable({
        ajax: cargarDatos,
        searching: true,
        columns: [
            { "data": "nombre" },
            { "data": "direccion" },
            { "data": "fecha_inicio" },
            { "data": "numero_integrantes" },
            { "data": "tipoOrganizacionNombre" }
        ],
        aoColumnDefs:
            [
                {
                    aTargets: [5],
                    mData: "id",
                    mRender: function (data, type, full) {
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idOrganizacion="' + data + '">Editar</button>';
                        acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idOrganizacion="' + data + '">Eliminar</button> </div>'
                        return acciones;
                    },
                },
                {
                    aTargets: [6],
                    mData: "id",
                    mRender: function (data, type, full) {
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="A" idOrganizacion="' + data + '">Añadir Miembros</button>';
                        return acciones;
                    },
                },
                {
                    aTargets: [7],
                    mData: "id",
                    mRender: function (data, type, full) {
                        var acciones = '<div class="btn-group"> <button class="btn btn-success waves-effect waves-light"  metodo="V" idOrganizacion="' + data + '">ver Miembros</button>';
                        return acciones;
                    },
                },

            ],

    });
}
function cargarModal() {
    $('#btnModalOrganizacion').on('click', function () {
        $('#btnFormOrganizacion').html('Guardar');
        $('#modalOrganizacion').modal('show');
        $('#opOrganizacion').val('I');
        $('#nombreOrganizacion').val('');
        $('#nombreOrganizacion').val('');
        $("#direccionOrganizacion").val('')
        $("#selectTipoOrganizacion").val('')
        $("#fechaOrganizacion").val('')
        $("#numeroIntegrantes").val('')
    })
}
function cerrarModal() {
    $('#modalOrganizacion').modal('hide');
}

function editarOrganizacion() {
    $('.listTablaOrganizacion').on('click', 'button', function () {
        var data = tablaOrganizacion.row($(this).parents('tr')).data();
        let metodo = $(this).attr('metodo');
        id = $(this).attr('idOrganizacion');
        if (metodo === 'U') {
            $('#idOrganizacion').val(id);
            $('#nombreOrganizacion').val(data.nombre);
            $("#direccionOrganizacion").val(data.direccion)
            $("#selectTipoOrganizacion").val(data.tipoOrganizacionId)
            //$('#selectTipoOrganizacion > option[value='+data.tipo_organizacion_id+']').attr('selected', 'selected');
            $("#fechaOrganizacion").val(data.fecha_inicio)
            $("#numeroIntegrantes").val(data.numero_integrantes)
            //$("#descripcionOrganizacion").val(data.)
            $('#modalOrganizacion').modal('show');
            $('#opOrganizacion').val(metodo);
        } else if (metodo === 'E') {
            $('#idOrganizacion').val(id)
            $('#opOrganizacion').val(metodo);
            $("#btnFormOrganizacion").trigger("click");
        }else if(metodo=== 'A'){
            $('#opOrganizacionPersona').val(metodo);
            $('#idOrganizacionPersona').val(id);
            $("#modalPersona").modal('show');
        }else if(metodo ==='V'){

            window.location.href =mostrarPersona+'?id='+id;


        }

    });
}
function GuardarOrganizacion() {
    $('#btnFormOrganizacion').click(function (e) {
        let Opdirectivo = $('#opOrganizacion').val();
        var formData = $('#formOrganizacion').serialize();
        var formPersona=$('#formPersonal').serialize();
        if (Opdirectivo === 'I') {
            crudDirectivo(formData);
        } else if (Opdirectivo === 'U') {
            crudDirectivo(formData);
        } else if (Opdirectivo === 'E') {
            Swal.fire({
                title: "Eliminando?",
                text: "Esta seguro de eliminar el registro!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Aceptar"
            }).then((result) => {
                if (result.isConfirmed) {
                    crudDirectivo(formData);
                }
            });
        } else if(Opdirectivo==='A'){
            crudPersona(formPersona);
        }
        e.preventDefault();
    })
}
function crudDirectivo(data) {
    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            //se ejecuta cuabndo se cierra el modal
            $('#modalOrganizacion').on('hidden.bs.modal', function () {
                $('.error-message').text('');
            });
            // Si hay errores, mostrarlos debajo de cada campo correspondiente
            if (response.errors) {
                $.each(response.errors, function (key, value) {
                    $("#" + key + "Error").text(value[0]);
                });
            } else {
                cerrarModal();
                $('.error-message').text('');
                $('#tablaOrganizacion').DataTable().ajax.reload();
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.success,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },

    });
}
function guardarPersona(){
    $('#btnFormPersona').click(function (e) {
        let Opdirectivo = $('#opOrganizacionPersona').val();
        var formData = $('#formOrganizacion').serialize();
        var formPersona=$('#formPersonal').serialize();
         if(Opdirectivo==='A'){
            crudPersona(formPersona);
        }
        e.preventDefault();
    })
}

function crudPersona(data) {
    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            //se ejecuta cuabndo se cierra el modal
            $('#modalPersona').on('hidden.bs.modal', function () {
                $('.error-message').text('');
            });
            // Si hay errores, mostrarlos debajo de cada campo correspondiente
            if (response.errors) {
                $.each(response.errors, function (key, value) {

                    $("#" + key + "Error").text(value[0]);
                });
            } else {
                cerrarModal();
                $('.error-message').text('');
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.success,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },

    });
}


