

$(document).ready(function(){
    var tablaDirectivo;
    cargarTabla();
    cargarModal();
    editarOrganizacion();
    GuardarOrganizacion();
});
function cargarTabla(){
    tablaDirectivo = $('#tablaOrganizacion').DataTable({
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
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idOrganizacion="' + data + '">Editar</button>';
                        acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idOrganizacion="' + data + '">Eliminar</button> </div>'
                        return acciones;
                    },
                },

            ],

    });
}
function cargarModal(){
    $('#btnModalOrganizacion').on('click',function(){
        $('#btnFormOrganizacion').html('Guardar');
        $('#modalOrganizacion').modal('show');
        $('#opOrganizacion').val('I');
        $('#nombreOrganizacion').val('');
    })
}
function cerrarModal(){
    $('#modalOrganizacion').modal('hide');

}

function editarOrganizacion(){
    $('.listTablaOrganizacion').on('click', 'button', function() {
        var data = tablaDirectivo.row($(this).parents('tr')).data();
        console.log(data);
        let metodo=$(this).attr('metodo');
        id=$(this).attr('idOrganizacion');
        if(metodo==='U'){
            $('#idOrganizacion').val(id);
            $('#nombreOrganizacion').val(data.nombre);
            $('#modalOrganizacion').modal('show');
            $('#opOrganizacion').val(metodo);
        }else if(metodo==='E'){
            $('#idOrganizacion').val(id)
            $('#opOrganizacion').val(metodo);
            $("#btnOrganizacion").trigger("click");
        }

    });
}
function GuardarOrganizacion(){
    $('#btnFormOrganizacion').click(function(e){
        alert('asd');
        let Opdirectivo=$('#opOrganizacion').val();
        var formData = $('#formOrganizacion').serialize();
        console.log(JSON.stringify(formData));
        if(Opdirectivo ==='I'){
            crudDirectivo(formData);
        }else if(Opdirectivo ==='U'){
            crudDirectivo(formData);
        }else if(Opdirectivo === 'E'){
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
                    crudDirectivo(formData);
                }
              });






        }
        e.preventDefault();
    })
}
function crudDirectivo(data){
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
                $('#tablaDirectivo').DataTable().ajax.reload();
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
