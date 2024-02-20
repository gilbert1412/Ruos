$(document).ready(function(){
    cargarTabla();
    cargarModal();
    GuardarTipoOrganizacion();
});
function cargarTabla(){
    //console.log(tipoOrganizacion.get);
    let table=new DataTable('#tablaTipoOrganizacion');
    // let table = new DataTable('#tablaTipoOrganizacion', {
    //     ajax: cargarDatos,
    //     columns: [
    //         { data: 'nombre' },

    //     ],
    // });
}
function cargarModal(){
    $('#btnModalTipoOrganizacion').on('click',function(){
        $('#modalTipoOrganizacion').modal('show');
        $('#nombreTipoOrganizacion').val('');
    })
}
function cerrarModal(){
    $('#modalTipoOrganizacion').modal('hide');

}
function GuardarTipoOrganizacion(){
    $('#formTipoOrganiazion').on('submit',(function(e){

        let nombre=$('#nombreTipoOrganizacion').val();
        $.ajax({
            type: 'post',
            url: guardarDatos,
            data: {'nombre':nombre},
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
                    $('.error-message').text('');
                    cerrarModal();
                    alert(response.success);

                }
            },

        });

        e.preventDefault();
    }))
}
