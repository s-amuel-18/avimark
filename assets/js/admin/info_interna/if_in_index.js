$(function() {
    $.validator.setDefaults({
        submitHandler: function(e) {
            e.submit();
            let buttonSubmit = e.querySelector("button[type='submit']")

            if (buttonSubmit) {
                buttonSubmit.disabled = true
            }

        }
    });

    // VALIDACION
    $('#form_cartera').validate({
        rules: {
            nombre: {
                required: true,
            },
            email: {
                required: true,
                email: true
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
    $('#nueva_cartera').on('show.bs.modal', function(e) {
        // alert();
        $form = document.getElementById("form_cartera");
        $form.action = "admin/carteras/crear";
        $form.reset();
        $form.id_cartera_input.value = 0;

        // console.log($form.nombre_usuario);return;
        $title_element = document.getElementById("title_modalnuevo_cartera");

        $button_target = e.relatedTarget;

        $id_cartera = $button_target.dataset.id;

        $title = $button_target.dataset.titulo;
        if ($title_element && $title) {
            $title_element.textContent = $title;
        }

        if ($id_cartera) {

            $datos = new FormData();
            $datos.append("id_cartera", $id_cartera);

            $.ajax({
                url: "admin/carteras/get_cartera",
                method: "POST",
                data: $datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    $form.nombre.value = response.nombre;
                    // $form.email.value = response.email;

                    $form.id_cartera_input.value = response.id;
                    // $form.telefono.value = response.telefono;
                    $form.email.value = response.email;

                    $form.action = "admin/carteras/actualizar";
                }
            })
        }

    })
});



$(function() {
    // VALIDACION
    $('#form_categoria').validate({
        rules: {
            nombre: {
                required: true,
            }
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
    $('#nueva_categoria').on('show.bs.modal', function(e) {
        $form = document.getElementById("form_categoria");
        $form.action = "admin/categorias/crear";
        $form.reset();
        $form.id_categoria_input.value = 0;

        // console.log($form.nombre_usuario);return;
        $title_element = document.getElementById("title_modalnuevo_categoria");

        $button_target = e.relatedTarget;

        $id_categoria = $button_target.dataset.id;

        $title = $button_target.dataset.titulo;
        if ($title_element && $title) {
            $title_element.textContent = $title;
        }

        if ($id_categoria) {

            $datos = new FormData();
            $datos.append("id_categoria", $id_categoria);

            $.ajax({
                url: "admin/categorias/get_categoria",
                method: "POST",
                data: $datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    $form.nombre.value = response.nombre;


                    $form.id_categoria_input.value = response.id;


                    $form.action = "admin/categorias/actualizar";
                }
            })
        }

    })


    $('#form_informacion_interna').validate({
        rules: {
            nombre_empresa: {
                required: true,
            },
            email_empresa: {
                required: true,
                email: true,
            },
            direccion_empresa: {
                required: true,
            },
            telefono_empresa: {
                required: true,
            }
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