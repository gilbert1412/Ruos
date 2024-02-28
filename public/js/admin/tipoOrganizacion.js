

$(document).ready(function(){
    var tablaTipoOrganizacion;
    cargarTabla();
    cargarModal();
    editarTipoOrganizacion();
    GuardarTipoOrganizacion();
});
function cargarTabla(){
    tablaTipoOrganizacion = $('#tablaTipoOrganizacion').DataTable({
        ajax: cargarDatos,
        searching: true,
        columns: [
            { "data": "nombre" },
        ],
        aoColumnDefs:
            [
                {
                    aTargets: [1],
                    mData: "id",
                    mRender: function (data, type, full) {
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idTipoOrganiozacion="' + data + '">Editar</button>';
                        acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idTipoOrganiozacion="' + data + '">Eliminar</button> </div>'
                        return acciones;
                    },
                },

            ],

    });
}
function cargarModal(){
    $('#btnModalTipoOrganizacion').on('click',function(){
        $('#btnFormTipoOrganizacion').html('Guardar');
        $('#modalTipoOrganizacion').modal('show');
        $('#opTipoOrganizacion').val('I');
        $('#nombreTipoOrganizacion').val('');
    })
}
function cerrarModal(){
    $('#modalTipoOrganizacion').modal('hide');

}

function editarTipoOrganizacion(){
    $('.listTablaTipoOrganizacion').on('click', 'button', function() {
        var data = tablaTipoOrganizacion.row($(this).parents('tr')).data();
        console.log(data);
        let metodo=$(this).attr('metodo');
        id=$(this).attr('idTipoOrganiozacion');
        if(metodo==='U'){
            $('#idTipoOrganizacion').val(id);
            $('#nombreTipoOrganizacion').val(data.nombre);
            $('#modalTipoOrganizacion').modal('show');
            $('#opTipoOrganizacion').val(metodo);
        }else if(metodo==='E'){
            $('#idTipoOrganizacion').val(id)
            $('#opTipoOrganizacion').val(metodo);
        }

    });
}
function GuardarTipoOrganizacion(){
    $('#btnFormTipoOrganizacion').click(function(e){
        let tipoOrganizacion=$('#opTipoOrganizacion').val();
        var formData = $('#formTipoOrganiazion').serialize();
        alert(formData)
        if(tipoOrganizacion ==='I'){
            crudTipoOrganizacion(formData);
        }else if(tipoOrganizacion ==='U'){
            crudTipoOrganizacion(data);
        }
        e.preventDefault();
    })
}
function crudTipoOrganizacion(data){
    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: {'data':data,},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            //se ejecuta cuabndo se cierra el modal
            $('#modalTipoOrganizacion').on('hidden.bs.modal', function () {
                $('.error-message').text('');
            });
            // Si hay errores, mostrarlos debajo de cada campo correspondiente
            if (response.errors) {
                $.each(response.errors, function(key, value) {
                    $("#" + key + "Error").text(value[0]);
                });
            } else{
                cerrarModal();
                $('.error-message').text('');
                $('#tablaTipoOrganizacion').DataTable().ajax.reload();
                alert(response.success);
            }
        },

    });
}
