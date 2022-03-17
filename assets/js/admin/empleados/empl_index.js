$(function() {
    // let form_eliminar_empleado = document.querySelectorAll(".form_eliminar_empleado");

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
    $('#form_empleado').validate({
        rules: {
            nombre: {
                required: true,
            },
            email: {
                email: true
            },
            cartera_id: {
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


    // modal 

    $('#nuevo_empleado').on('show.bs.modal', function(e) {
        $form = document.getElementById("form_empleado");
        $form.action = "admin/empleados/crear";
        $form.reset();
        $form.id_empleado_input.value = 0;

        // console.log($form.nombre_usuario);return;
        $title_element = document.getElementById("title_modalnuevo_empleado");

        $button_target = e.relatedTarget;

        $id_empleado = $button_target.dataset.id;

        $title = $button_target.dataset.titulo;
        if ($title_element && $title) {
            $title_element.textContent = $title;
        }


        if ($id_empleado) {

            $datos = new FormData();
            $datos.append("id_empleado", $id_empleado);

            $.ajax({
                url: "admin/empleados/get_empleado",
                method: "POST",
                data: $datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $form.nombre.value = response.nombre;
                    $form.email.value = response.email;

                    if (response.cartera_id) {
                        for (let i = 0; i < $form.cartera_id.length; i++) {
                            if ($form.cartera_id[i].value === response.cartera_id) {
                                $form.cartera_id.selectedIndex = i;
                            }
                        }
                    }

                    $form.id_empleado_input.value = response.id;
                    $form.action = "admin/empleados/actualizar";
                }
            })
        }

    })


    // $(".form_eliminar_empleado").on("submit", e => {
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