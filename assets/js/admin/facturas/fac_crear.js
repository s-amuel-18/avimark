$insert_categorias = document.getElementById("insert_categoria_seleccionada");
$arr_categorias = [];


$(function() {
    // VALIDACION
    $('#form_nueva_factura').validate({
        rules: {
            nombre_empresa: {
                required: true,
            },
            direccion_empresa: {
                required: true,
            },
            telefono_empresa: {
                required: true,
            },
            email_empresa: {
                required: true,
            },
            cliente: {
                required: true,
            },
            cartera: {
                required: true,
            },
            job_services: {
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