$(document).ready(function(){
    var tablaPersona;
    cargarTabla();
    // cargarModal();
    // editarDirectivo();
    // GuardarDirectivo();
});
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
