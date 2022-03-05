$(function () {
  bsCustomFileInput.init();

  // VALIDACION
  $('#form_usuario').validate({
    rules: {
      nombre: {
        required: true,
      },
      nombre_usuario: {
        required: true,
      },
      perfil: {
        required: true,
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
  
  $('#nuevo_usuario').on('show.bs.modal', function (e) {
    $form = document.getElementById("form_usuario");
    $form.action = "admin/usuarios/crear";
    $form.reset();
    $form.nombre_usuario.removeAttribute("readonly");
    $form.id_usuario_input.value = 0;
    
    // console.log($form.nombre_usuario);return;
    $title_element = document.getElementById("title_modalnuevo_usuario");

    $button_target = e.relatedTarget;
    
    $id_usuario = $button_target.dataset.id;
    
    $title = $button_target.dataset.titulo;
    if( $title_element && $title ) {
      $title_element.textContent = $title; 
    } 

    if( $id_usuario ) {

      $datos = new FormData();
      $datos.append("id_usuario", $id_usuario);
      
      $.ajax({
        url: "admin/usuario/get_usuario",
        method: "POST",
        data: $datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response) {

          $form.nombre.value = response.nombre;
          $form.nombre_usuario.value = response.nombre_usuario;
          $form.nombre_usuario.setAttribute("readonly", "true");
          
          $form.id_usuario_input.value = response.id;
          $form.password.required = false;
          $form.action = "admin/usuarios/actualizar";
          
          for (let i = 0; i < $form.perfil.length; i++) {
            if( $form.perfil[i].value === response.perfil ) {
              $form.perfil.selectedIndex = i ;
              // console.log($form.perfil.selectedIndex);
            } 
          }

        }
      })
    }

  })
});