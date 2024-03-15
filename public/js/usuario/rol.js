

$(document).ready(function(){

    var tablaRol;
    cargarTabla();
    cargarModal();
    editarRol();
    GuardarRol();

});
function cargarTabla(){
    tablaRol = $('#tablaRol').DataTable({
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
                        var acciones = '<div class="btn-group"> <button class="btn btn-info waves-effect waves-light"  metodo="U" idRol="' + data + '">Editar</button>';
                        acciones += '<button class="btn btn-danger waves-effect waves-light" metodo="E" idRol="' + data + '">Eliminar</button> </div>'
                        return acciones;
                    },
                },
                {
                    aTargets: [2],
                    mData: "id",
                    mRender: function (data, type, full) {
                        var acciones = '<div class="btn-group"> <button class="btn btn-success waves-effect waves-light"  metodo="P" idRol="' + data + '">Agregar Permisos</button>';
                        return acciones;
                    },
                },

            ],

    });
}
function cargarModal(){
    $('#btnModalRol').on('click',function(){
        $('#btnFormRol').html('Guardar');
        $('#modalRol').modal('show');
        $('#opRol').val('I');
        $('#nombreRol').val('');
    })
}
function cerrarModal(){
    $('#modalRol').modal('hide');
}

function editarRol(){
    $('.listTablaRol').on('click', 'button', function() {
        var data = tablaRol.row($(this).parents('tr')).data();
        console.log(data);
        let metodo=$(this).attr('metodo');
        id=$(this).attr('idRol');
        //alert(id)
        if(metodo==='U'){
            $('#idRol').val(id);
            $('#nombreRol').val(data.name);
            $('#modalRol').modal('show');
            $('#opRol').val(metodo);
        }else if(metodo==='E'){
            $('#idRol').val(id)
            $('#opRol').val(metodo);
            $("#btnFormRol").trigger("click");
        }else if(metodo === 'P'){
            $('#nombreRolPermiso').val(data.name);
            $('#opRolPermiso').val(metodo);
            $('#idRolPermiso').val(id);
            $('#modalPermiso').modal('show');
            guardarRolPermiso();
        }

    });
}
function guardarRolPermiso(){
    $('#btnFornRolPermiso').click(function(e){
        //var formRolPermisos=$('#formRolPermiso').serialize();
        var formRolPermisos=new FormData($("#modalPermiso"));
        alert( JSON.stringify(formRolPermisos));
        // var check=document.querySelectorAll('.checkbox');
        // //alert( JSON.stringify( check))
        // let OpRolPermiso = $('#opOrganizacionPersona').val();
        // var newData=[];
        // check.forEach((e)=>{
        //     //alert(JSON.stringify(e.name))
        //     if(e.checked==true){
        //         newData.push(e.name);
        //         console.log(e.value);
        //     }
        // })
        // var newDataSerialized = (newData);
        // alert(newDataSerialized);
        // var combinedData = formRolPermisos + '&' + newDataSerialized;
        // alert(combinedData)
        //console.log(JSON.stringify(formRolPermisos));
    })
}
// function serializeForm($form) {
//     var formData = $form.serializeArray();
//     // Obtener los checkboxes y agregarlos a formData con valor 1 si están marcados o 0 si no lo están
//     $form.find('input[type=checkbox]').each(function() {
//         var value = this.checked ? '1' : '0';
//         formData.push({name: this.name, value: value});
//     });
//     return $.param(formData);
// }




function GuardarRol(){
    $('#btnFornRol').click(function(e){
        let OpRol=$('#opRol').val();
        var formData = $('#formRol').serialize();
        console.log(formData);
        if(OpRol ==='I'){
            crudRol(formData);
        }else if(OpRol ==='U'){
            crudRol(formData);
        }else if(OpRol === 'E'){
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
                    crudRol(formData);
                }
              });






        }
        e.preventDefault();
    })
}
function crudRol(data){
    $.ajax({
        type: 'post',
        url: guardarDatos,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            //se ejecuta cuabndo se cierra el modal
            $('#modalRol').on('hidden.bs.modal', function () {
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
                $('#tablaRol').DataTable().ajax.reload();
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

