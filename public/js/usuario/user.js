

$(document).ready(function () {
    var tablaUsuario;
    cargarTabla();
    cargarModal();
    editarUsuario();
    GuardarUsuario();
    $('#modalUsuario').on('hidden.bs.modal', function () {

        $('[name="role[]"]').prop('checked', false);
    });
});
function cargarTabla() {
    tablaUsuario = $('#tablaUsuario').DataTable({
        ajax: cargarDatos,
        searching: true,
        columns: [
            { "data": "name" },
            { "data": "email" },


        ],
        aoColumnDefs:
            [
                {
                    aTargets: [2],
                    mData: "id",
                    mRender: function (data, type, full) {
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idUsuario="' + data + '">Añadir Roles</button>';
                        acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idUsuario="' + data + '">Eliminar</button> </div>'
                        return acciones;
                    },
                },




            ],

    });
}
function cargarModal() {
    $('#btnModalUsuario').on('click', function () {
        $('#nombreUsuario').prop('disabled',false);
        $("#email").prop('disabled',false);
        $('#contraUsuario').prop('hidden',false);
        $('#labelContra').prop('hidden',false);
        $('#btnFormUsuario').html('Guardar');
        $('#modalUsuario').modal('show');
        $('#opUsuario').val('I');
        $('#nombreUsuario').val('');
        $('#email').val('');

    })
}
function cerrarModal() {
    $('#modalUsuario').modal('hide');
}

function editarUsuario() {
    $('.listTablaUsuario').on('click', 'button', function () {
        var data = tablaUsuario.row($(this).parents('tr')).data();
        let metodo = $(this).attr('metodo');
        id = $(this).attr('idUsuario');
        if (metodo === 'U') {
            var id=$('#idUsuario').val(id);
            $('#nombreUsuario').val(data.name);
            $("#email").val(data.email);
            $('#nombreUsuario').prop('disabled',true);
            $("#email").prop('disabled',true);
            $('#contraUsuario').prop('hidden',true);
            $('#labelContra').prop('hidden',true);
            $('#modalUsuario').modal('show');
            $('#opUsuario').val(metodo);
            var data={'id':id.val()};
            mostrarCheckbox(data);
        } else if (metodo === 'E') {
            $('#idUsuario').val(id)
            $('#opUsuario').val(metodo);
            $("#btnFormUsuario").trigger("click");
        }

    });
}
function GuardarUsuario() {
    $('#btnFornUsuario').click(function (e) {
        let OpUsuario = $('#opUsuario').val();
        var formData = $('#formUsuario').serialize();
        if (OpUsuario === 'I') {
            crudUsuario(formData);
        } else if (OpUsuario === 'U') {
            crudUsuario(formData);
        } else if (OpUsuario === 'E') {
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
                    crudUsuario(formData);
                }
            });
        }
        e.preventDefault();
    })
}
function crudUsuario(data) {

    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            //se ejecuta cuabndo se cierra el modal
            $('#modalUsuario').on('hidden.bs.modal', function () {
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
                $('#tablaUsuario').DataTable().ajax.reload();
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
function mostrarCheckbox(data){
    $.ajax({
        type: 'post',
        url: cargarCheckbox,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            response.forEach(({id, pivot}) => {
                $('#checkbox' + pivot.role_id).prop('checked', true);
            });

        },

    });
}
