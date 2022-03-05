<?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

<?php $this->load->view("admin/components/alert");?>

<form action="<?php echo site_url("iniciar_sesion") ?>" method="post">

  <!-- Nombre de usuario -->
  <div class="input-group mb-3">
    <input name="nombre_usuario" type="text" class="form-control" placeholder="Nombre De Usuario" autofocus>
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>

  <!-- contraseña -->
  <div class="input-group mb-3">
    <input name="contraseña" type="password" class="form-control" placeholder="Contraseña">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6">

    </div>
    <!-- /.col -->
    <div class="col-6">
      <button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
    </div>
    <!-- /.col -->
  </div>
</form>