
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php $this->load->view("admin/template/head"); ?>
<!-- head -->

<body class="hold-transition dark-mode login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Avimark</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Iniciar Sesion</p>
        {body}



    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<?php 
if( isset($_SESSION["message"]) ) {
  unset($_SESSION["message"]);
  // unset($_SESSION["message"]);
}
?>

</body>


</html>