var tabla;
$(document).ready(function(){
    cargarTabla();
    editarModal();
    guardarPersona();
});
function cargarTabla(){
    tabla=$('#tablaPersona').DataTable({
        columns: [
            { "data": "apePaterno" },
            { "data": "apeMaterno" },
            { "data": "nombre" },
            {"data":"dni"},
            {"data":"direccion"},
            {"data":"celular"},
            {"data":"cargo"},
            {"data":"acciones"},
            {"data":"directivosId"},

        ],
    })
}
function editarModal(){
    $('.listTablaPersona').on('click', 'button', function () {
        var data=tabla.row($(this).parents('tr')).data();
        console.log(JSON.stringify(data));
        let metodo = $(this).attr('metodo');
        id = $(this).attr('idPersona');
        if(metodo==='U'){
            $("#apePaterno").val(data.apePaterno);
            $("#apeMaterno").val(data.apeMaterno);
            $("#nombre").val(data.nombre);
            $("#dni").val(data.dni);
            $("#direccion").val(data.direccion);
            $("#celular").val(data.celular);
            $('#opPersona').val(metodo);
            $('#idPersona').val(id);
            $("#selectDirectivo").val(data.directivosId);
            $('#modalPersona').modal('show');
        }else if(metodo==='E'){
            $('#opPersona').val(metodo);
            $('#idPersona').val(id);
            $("#btnFormPersona").trigger("click");
        }

    })
}
function guardarPersona() {
    $('#btnFormPersona').click(function (e) {
        let opPersona = $('#opPersona').val();
        var formData = $('#formPersonal').serialize();
        var formPersona=$('#formPersonal').serialize();
        console.log(JSON.stringify(opPersona));
        if (opPersona === 'U') {
            crudPersona(formData);
        } else if (opPersona === 'E') {
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
                    crudPersona(formData);
                }
            });
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
                    console.log("hola"+key);
                    $("#" + key + "Error").text(value[0]);
                });
            } else {
                $('#modalPersona').modal('hide');
                $('.error-message').text('');
                // Swal.fire({
                //     position: "top-end",
                //     icon: "success",
                //     title: response.success,
                //     showConfirmButton: false,
                //     timer: 1500
                // });
                location.reload();
            }
        },

    });
}


function cargarTablaPersona(){
    tablaPersona = $('#tablaPersona').DataTable({
        ajax: listarPersona,
        searching: true,
        columns: [
            { "data": "apePaterno" },
            { "data": "apeMaterno" },
            { "data": "nombre" },
            {"data":"dni"},
            {"data":"direccion"},
            {"data":"celular"},
            {"data":"cargo"}
        ],
        aoColumnDefs:
            [
                {
                    aTargets: [8],
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
