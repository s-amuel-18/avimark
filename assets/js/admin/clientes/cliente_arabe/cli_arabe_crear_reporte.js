$(function() {
    // $.validator.setDefaults({
    //     submitHandler: function(e) {
    //         e.submit();
    //         let buttonSubmit = e.querySelector("button[type='submit']")

    //         if (buttonSubmit) {
    //             buttonSubmit.disabled = true
    //         }

    //     }
    // });

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



    // capturar el evento submit del formulario
    const for1m_reporte_arabe = document.getElementById("form_reporte_arabe");
    // alert();
    form_reporte_arabe.addEventListener("submit", e => {
        // e.preventDefault();

        const inputs_servicio = e.target.querySelectorAll(".input_reporte_servicio");

        let obj_servicios = {};

        Array.from(inputs_servicio).forEach(el => {
            obj_servicios[el.dataset.id] = {
                nombre_servicio: el.dataset.servicio,
                arr_cantidades: [],
            };
        });

        Array.from(inputs_servicio).forEach(el => {
            obj_servicios[el.dataset.id].arr_cantidades.push(Number(el.value));
        });

        // console.log(obj_servicios);
        // return false;


        for (const key in obj_servicios) {
            if (Object.hasOwnProperty.call(obj_servicios, key)) {
                const arr = obj_servicios[key].arr_cantidades;
                const nombre_servicio = obj_servicios[key].nombre_servicio;

                const cantidad_de_repetido = count_num_max_en_arr(arr);
                const num_mayor = Math.max(...arr);

                if (cantidad_de_repetido > 1) {
                    e.preventDefault();

                    Swal.fire(
                        'Alerta',
                        'En el servicio ' + nombre_servicio + ' esta repetida la cantidad ' + num_mayor + ' como mayor cantidad realizada, esto puede ocacionar problemas con el pago del empleado, por favor rectifica',
                        'warning'
                    );

                    // alert("Debes tener en cuenta que el numero maximo de el servicio")
                }

            }
        }

        // console.log(obj_servicios);
    })

});