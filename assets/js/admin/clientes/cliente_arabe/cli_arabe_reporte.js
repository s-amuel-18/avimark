$(function() {
    // let form_eliminar_cliente = document.querySelectorAll(".form_eliminar_cliente");
    // alert();


    // VALIDACION
    $('#form_reporte_arabe').validate({
        rules: {
            bono: {
                required: true,
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

});