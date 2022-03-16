$(function() {
    // let form_eliminar_servicio = document.querySelectorAll(".form_eliminar_servicio");



    // VALIDACION
    $('#form_servicio').validate({
        rules: {
            nombre: {
                required: true,
            },
            precio_total: {
                required: true,
                number: true
            },
            precio_empleado: {
                required: true,
                number: true
            },
            precio_empleado_mayor: {
                number: true
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


    // modal 

    $('#nuevo_servicio').on('show.bs.modal', function(e) {
        $form = document.getElementById("form_servicio");
        $form.action = "admin/servicios/crear";
        $form.reset();
        $form.id_servicio_input.value = 0;

        // console.log($form.nombre_usuario);return;
        $title_element = document.getElementById("title_modalnuevo_servicio");

        $button_target = e.relatedTarget;

        $id_servicio = $button_target.dataset.id;

        $title = $button_target.dataset.titulo;
        if ($title_element && $title) {
            $title_element.textContent = $title;
        }

        if ($id_servicio) {

            $datos = new FormData();
            $datos.append("id_servicio", $id_servicio);

            $.ajax({
                url: "admin/servicios/get_servicio",
                method: "POST",
                data: $datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    $form.nombre.value = response.nombre;
                    $form.precio_total.value = response.precio_total;
                    $form.precio_empleado.value = response.precio_empleado;
                    $form.precio_empleado_mayor.value = response.precio_empleado_mayor;

                    $form.id_servicio_input.value = response.id;

                    $form.action = "admin/servicios/actualizar";
                }
            })
        }

    })

    const form_servicio = document.getElementById("form_servicio");

    form_servicio.addEventListener("submit", e => {
        let precio_total = Number(form_servicio.precio_total.value);
        let precio_empleado = Number(form_servicio.precio_empleado.value);
        let precio_empleado_mayor = Number(form_servicio.precio_empleado_mayor.value);
        console.log(precio_empleado_mayor)

        if ((precio_empleado >= precio_total) || (precio_empleado_mayor > 0 && (precio_empleado_mayor >= precio_total || precio_empleado >= precio_empleado_mayor))) {
            e.preventDefault();

            Swal.fire(
                'Alerta',
                "El precio del Empleado no puedo ser mayor o igual al precio del empleado mayor y el precio del empleado mayor no puede ser mayor o igual al precio total, verifica",
                'warning'
            )

        }
    })
});