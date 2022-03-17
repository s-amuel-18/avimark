$(function() {
    // let form_eliminar_cliente = document.querySelectorAll(".form_eliminar_cliente");

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
    $('#form_cliente').validate({
        rules: {
            nombre: {
                required: true,
            },
            nombre_empresa: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            telefono: {
                minlength: 11,
                maxlength: 20
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

    $('#nuevo_cliente').on('show.bs.modal', function(e) {
        $form = document.getElementById("form_cliente");
        $form.action = "admin/clientes/crear";
        $form.reset();
        $form.id_cliente_input.value = 0;

        // console.log($form.nombre_usuario);return;
        $title_element = document.getElementById("title_modalnuevo_cliente");

        $button_target = e.relatedTarget;

        $id_cliente = $button_target.dataset.id;

        $title = $button_target.dataset.titulo;
        if ($title_element && $title) {
            $title_element.textContent = $title;
        }

        if ($id_cliente) {

            $datos = new FormData();
            $datos.append("id_cliente", $id_cliente);

            $.ajax({
                url: "admin/clientes/get_cliente",
                method: "POST",
                data: $datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {

                    $form.nombre.value = response.nombre;
                    $form.nombre_empresa.value = response.nombre_empresa;

                    $form.id_cliente_input.value = response.id;
                    $form.telefono.value = response.telefono;
                    $form.email.value = response.email;

                    $form.action = "admin/clientes/actualizar";
                }
            })
        }

    })



    // $(".form_eliminar_cliente").on("submit", e => {
    //   // e.preventDefault();
    //     Swal.fire({
    //         title: '¿Realmente deseae?',
    //         showDenyButton: true,
    //         showCancelButton: true,
    //         confirmButtonText: 'Save',
    //         denyButtonText: `Don't save`,
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             Swal.fire('Saved!', '', 'success')
    //         } else if (result.isDenied) {
    //             e.preventDefault();
    //             Swal.fire('Changes are not saved', '', 'info')
    //         }
    //     })

    // })


});