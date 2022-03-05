<script>
  const site_url = "<?php echo site_url("/") ?>";
</script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/admin-lte/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url() ?>assets/admin-lte/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>assets/admin-lte/js/pages/dashboard2.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url() ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="<?php echo base_url() ?>assets/plugins/dropzone/min/dropzone.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- axios -->
<script src="<?php echo base_url() ?>assets/js/axios.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/clipboard/clipboard.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- admin lte -->
<!-- <script src="<?php echo base_url() ?>assets/admin-lte/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url() ?>assets/admin-lte/js/demo.js"></script> -->

<!-- functions -->
<script src="<?php echo base_url() ?>assets/functions/functions_http.js"></script>

<div class="d-none">
  {scripts}
</div>

<script>
  $(function() {
    //Money Euro
    $('[data-mask]').inputmask()

    let obj_dataTable = {
      "responsive": true,
      "autoWidth": false,
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
      "buttons": ["csv", "excel"]
    };

    $("#table").DataTable(obj_dataTable).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    $(".table_data_tr").DataTable(obj_dataTable);

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

  <?php if (isset($_SESSION["message"])) : ?>
    const message = "<?php echo $_SESSION["message"]["message"] ?>";

    // toastr.<?php echo $_SESSION["message"]["type"] ?>(message);

    Swal.fire(
      '<?php echo $_SESSION["message"]["type"] ?>',
      message,
      '<?php echo $_SESSION["message"]["type"] ?>'
    )

  <?php
    unset($_SESSION["message"]);
  endif;
  ?>

  const avatarInput = document.querySelector('#photo_perfil_input');
  // const avatarName = document.querySelector('.input_file__button');
  const imagePreview = document.querySelector('#photo_perfil');
  const photo_perfil_aside = document.querySelector('#photo_perfil_aside');
  // const button_select_img = document.querySelector('#select_photo_perfil');
  // alert("sdsa");
  avatarInput.addEventListener('change', e => {
    // envio de foto

    let input = e.currentTarget;
    let fileName = input.files[0].name;
    const file = input.files[0];

    if (!file.type.includes("image/")) {
      toastr.error("el archivo subido debe ser una imagen");
      input.value = "";
      imagePreview.setAttribute('src', "https://i.ibb.co/0Jmshvb/no-image.png");
      return;
    }
    post_foto_perfil('<?php echo site_url("admin_proyecto/upload_foto_perfil") ?>')
    // button_select_img.innerText = `File: ${fileName}`;

    const fileReader = new FileReader();
    fileReader.addEventListener('load', e => {
      let imageData = e.target.result;
      imagePreview.setAttribute('src', imageData);
      photo_perfil_aside.setAttribute('src', imageData);
    })

    fileReader.readAsDataURL(input.files[0]);
  });
  var clipboard = new ClipboardJS('.copy');

  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>