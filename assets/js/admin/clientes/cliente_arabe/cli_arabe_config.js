(function() {
    const form = document.getElementById("form_cli_arabe_config");
    const check_empleados = document.querySelectorAll(".check_empleados");
    const check_servicios = document.querySelectorAll(".check_servicios");

    if (!form) return false;

    // alert();
    form.addEventListener("submit", e => {

        $validate_empleados = validate_checks(check_empleados);
        $validate_servicios = validate_checks(check_servicios);


        if (!$validate_empleados || !$validate_servicios) {
            e.preventDefault();

            Swal.fire(
                'Alerta',
                "Es obligatorio Seleccionar como minimo un servicio y un empleado",
                'warning'
            );
        }

    })
})();


$(function() {
    // let form_eliminar_cliente = document.querySelectorAll(".form_eliminar_cliente");



    // VALIDACION
    $('#form_cli_arabe_config').validate({
        rules: {
            cliente_id: {
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