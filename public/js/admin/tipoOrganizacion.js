$(document).ready(function(){
    cargarModal();
    GuardarTipoOrganizacion();
});

function cargarModal(){
    $('#btnModalTipoOrganizacion').on('click',function(){
        $('#modalTipoOrganizacion').modal('show');
    })
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
                    $('#modalTipoOrganizacion').modal('hide');
                    $('#nombreTipoOrganizacion').val('');
                    alert(response.success);

                }
            },

        });

        e.preventDefault();
    }))
}
