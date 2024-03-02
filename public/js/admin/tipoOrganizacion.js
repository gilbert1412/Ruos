

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
        alert(id);
        if(metodo==='U'){
            $('#idTipoOrganizacion').val(id);
            $('#nombreTipoOrganizacion').val(data.nombre);
            $('#modalTipoOrganizacion').modal('show');
            $('#opTipoOrganizacion').val(metodo);
        }else if(metodo==='E'){
            $('#idTipoOrganizacion').val(id)
            $('#opTipoOrganizacion').val(metodo);
            $("#btnFormTipoOrganizacion").trigger("click");
        }

    });
}
function GuardarTipoOrganizacion(){
    $('#btnFormTipoOrganizacion').click(function(e){
        let tipoOrganizacion=$('#opTipoOrganizacion').val();
        var formData = $('#formTipoOrganiazion').serialize();
        if(tipoOrganizacion ==='I'){
            crudTipoOrganizacion(formData);
        }else if(tipoOrganizacion ==='U'){
            console.log(tipoOrganizacion);
            crudTipoOrganizacion(formData);
        }else if(tipoOrganizacion === 'E'){
            Swal.fire({
                title: "Eliminando?",
                text: "Esta seguro de eliminar el registro!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText:"Cancelar",
                confirmButtonText: "Aceptar"
              }).then((result) => {
                if (result.isConfirmed) {
                    crudTipoOrganizacion(formData);
                }
              });






        }
        e.preventDefault();
    })
}
function crudTipoOrganizacion(data){
    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: data,
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
                    console.log(key);
                    $("#" + key + "Error").text(value[0]);
                });
            } else{
                cerrarModal();
                $('.error-message').text('');
                $('#tablaTipoOrganizacion').DataTable().ajax.reload();
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
