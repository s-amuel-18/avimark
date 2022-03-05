$(function () {
  $("#emails_tr")
    .on("init.dt", function (e) {
      // this.DataTable({
      //   "buttons": [ "csv", "excel"],
      // }).buttons().container().appendTo('#emails_tr_wrapper .col-md-6:eq(0)');

      // console.log(this)



    })
    .DataTable({
      "ajax": "admin/emails_contacto/ajax_emails",
      "responsive": true,
      "autoWidth": false,
      // "processing": true,
      // "serverSide": true,
      "dom": "Bfrtip",
      "language": {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      "buttons": ["csv", "excel"],
    })

  //Money Euro
  $('[data-mask]').inputmask()

  // VALIDACION
  $('#form_email_contacto').validate({
    rules: {
      nombre: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      url: {
        required: true,
        url: true
      },


    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });


  // modal 

  $('#nuevo_email_contacto').on('show.bs.modal', function (e) {
    $form = document.getElementById("form_email_contacto");
    $form.action = "admin/emails_contacto/crear";
    $form.reset();
    $form.id_email_input.value = 0;
    $form.descripcion.textContent = "";

    $title_element = document.getElementById("title_modalnuevo_email_contacto");

    $button_target = e.relatedTarget;

    $id_email = $button_target.dataset.id;

    $title = $button_target.dataset.titulo;
    if ($title_element && $title) {
      $title_element.textContent = $title;
    }

    if ($id_email) {
      // alert();

      $datos = new FormData();
      $datos.append("id_email", $id_email);

      $.ajax({
        url: "admin/emails_contacto/get_email",
        method: "POST",
        data: $datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          // console.log(response)
          // console.log($id_email)
          $form.nombre.value = response.nombre;
          $form.email.value = response.email;
          $form.url.value = response.url;
          $form.descripcion.textContent = response.descripcion;


          $form.id_email_input.value = response.id;

          if (response.categoria_id) {
            for (let i = 0; i < $form.categoria_id.length; i++) {
              if ($form.categoria_id[i].value === response.categoria_id) {
                $form.categoria_id.selectedIndex = i;
              }
            }
          }


          $form.action = "admin/emails_contacto/actualizar";
        }
      })
    }

  })


});