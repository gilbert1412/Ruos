

$(document).ready(function(){
    var tablaDirectivo;
    cargarTabla();
    cargarModal();
    editarDirectivo();
    GuardarDirectivo();
});
function cargarTabla(){
    tablaDirectivo = $('#tablaDirectivo').DataTable({
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
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idDirectivo="' + data + '">Editar</button>';
                        acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idDirectivo="' + data + '">Eliminar</button> </div>'
                        return acciones;
                    },
                },

            ],

    });
}
function cargarModal(){
    $('#btnModalDirectivo').on('click',function(){
        $('#btnFormDirectivo').html('Guardar');
        $('#modalDirectivo').modal('show');
        $('#opDirectivo').val('I');
        $('#nombreDirectivo').val('');
    })
}
function cerrarModal(){
    $('#modalDirectivo').modal('hide');

}

function editarDirectivo(){
    $('.listTablaDirectivo').on('click', 'button', function() {
        var data = tablaDirectivo.row($(this).parents('tr')).data();
        console.log(data);
        let metodo=$(this).attr('metodo');
        id=$(this).attr('idDirectivo');
        if(metodo==='U'){
            $('#idDirectivo').val(id);
            $('#nombreDirectivo').val(data.nombre);
            $('#modalDirectivo').modal('show');
            $('#opDirectivo').val(metodo);
        }else if(metodo==='E'){
            $('#idDirectivo').val(id)
            $('#opDirectivo').val(metodo);
            $("#btnFormDirectivo").trigger("click");
        }

    });
}
function GuardarDirectivo(){
    $('#btnFormDirectivo').click(function(e){
        let Opdirectivo=$('#opDirectivo').val();
        var formData = $('#formDirectivo').serialize();
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
