var tabla;
$(document).ready(function(){
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
    editarModal();
});
function cargarTabla(){

}
function editarModal(){
    $('.listTablaPersona').on('click', 'button', function () {
        var data=tabla.row($(this).parents('tr')).data();
        console.log(JSON.stringify(data));

        $("#apePaterno").val(data.apePaterno);
        $("#apeMaterno").val(data.apeMaterno);
        $("#nombre").val(data.nombre);
        $("#dni").val(data.dni);
        $("#direccion").val(data.direccion);
        $("#celular").val(data.celular);
        $("#selectDirectivo").val(data.directivosId);
        $('#modalPersona').modal('show');
    })
}




function cargarTabla(){
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
