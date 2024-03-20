

$(document).ready(function(){

    var tablaPermiso;
    cargarTabla();
    cargarModal();
    editarPermiso();
    GuardarPermiso();
});
function cargarTabla(){
    tablaPermiso = $('#tablaPermiso').DataTable({
        ajax: cargarDatos,
        searching: true,
        columns: [
            { "data": "name" },
        ],
        aoColumnDefs:
        [
            {
                aTargets: [1],
                mData: "id",
                mRender: function (data, type, full) {
                var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idPermiso="' + data + '">Editar</button>';
                acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idPermiso="' + data + '">Eliminar</button> </div>'
                return acciones;
                },
            },



        ],

    });
}
function cargarModal(){
    $('#btnModalPermiso').on('click',function(){
        $('#btnFormPermiso').html('Guardar');
        $('#modalPermiso').modal('show');
        $('#opPermiso').val('I');
        $('#nombrePermiso').val('');
    })
}
function cerrarModal(){
    $('#modalPermiso').modal('hide');
}

function editarPermiso(){
    $('.listTablaPermiso').on('click', 'button', function() {
        var data = tablaPermiso.row($(this).parents('tr')).data();
        let metodo=$(this).attr('metodo');
        id=$(this).attr('idPermiso');
        if(metodo==='U'){
            $('#idPermiso').val(id);
            $('#nombrePermiso').val(data.name);
            $('#modalPermiso').modal('show');
            $('#opPermiso').val(metodo);
        }else if(metodo==='E'){
            $('#idPermiso').val(id)
            $('#opPermiso').val(metodo);
            $("#btnFormPermiso").trigger("click");
        }

    });
}
function GuardarPermiso(){
    $('#btnFornPermiso').click(function(e){
        let OpPermiso=$('#opPermiso').val();
        var formData = $('#formPermiso').serialize();
        if(OpPermiso ==='I'){
            crudPermiso(formData);
        }else if(OpPermiso ==='U'){
            crudPermiso(formData);
        }else if(OpPermiso === 'E'){
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
                    crudPermiso(formData);
                }
              });
        }
        e.preventDefault();
    })
}
function crudPermiso(data){
    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            //se ejecuta cuabndo se cierra el modal
            $('#modalPermiso').on('hidden.bs.modal', function () {
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
                $('#tablaPermiso').DataTable().ajax.reload();
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
