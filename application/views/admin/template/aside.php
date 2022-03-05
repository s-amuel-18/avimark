<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a target="_blanck" href="<?php echo site_url("portafolio") ?>" class="brand-link">
    <img src="<?php echo base_url() ?>assets/admin-lte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Avimark Studio</span>
  </a>
  <a href="" target="_blanck"></a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image" style="cursor:pointer;" data-toggle="modal" data-target="#modal_photo_perfil">
        <img src="<?php echo $this->session->userdata("foto") ?>" id="photo_perfil_aside" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="" class="d-block"><?php echo $this->session->userdata("nombre") ?></a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo site_url("admin_dashboard") ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Inicio
            </p>
          </a>
        </li>

        <?php if ($this->session->userdata("perfil") == "administrador") : ?>
          <!-- usuarios -->
          <li class="nav-item">
            <a href="<?php echo site_url("admin_usuarios") ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>

        <?php endif ?>

        <?php if ($this->session->userdata("perfil") == "administrador" OR $this->session->userdata("perfil") == "editor") : ?>
          <!-- Proyectos -->
          <li class="nav-item">
            <a href="<?php echo site_url("admin_info_interna") ?>" class="nav-link">
              <i class="nav-icon fas fa-info fa-fw"></i>
              <p>
                Informacion Interna
              </p>
            </a>
          </li>

          <!-- Facturacion -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-bill fa-fw"></i>
            <p>
            Facturacion
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo site_url("admin_facturas")?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Facturas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url("admin_facturas/vista_crear")?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear Factura</p>
              </a>
            </li>

          </ul>
        </li>
        <?php endif ?>

        <!-- Clientes -->
        <li class="nav-item">
          <a href="<?php echo site_url("admin_clientes") ?>" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Clientes
            </p>
          </a>
        </li>



        <!-- trabajos -->
        <li class="nav-item">
          <a href="<?php echo site_url("admin_emails_contacto") ?>" class="nav-link">
            <i class="fas fa-at  nav-icon "></i>
            <p>
              Emails a contactar
            </p>
          </a>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div id="modal_photo_perfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="my-modal-title">Seleccionar Imagen</h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          <img id="photo_perfil" src="<?php echo $image ? base_url($image) : base_url("assets/admin-lte/img/user2-160x160.jpg"); ?>" class="w-100" style=" max-width: 200px;" alt="">
        </div>

        <form id="form_foto" enctype="multipart/form-data">
          <div class="form-group mt-3">
            <label for="photo_perfil_input" class="btn btn-primary btn-block m-auto" style="width: fit-content;"><i class="far fa-images"></i> Seleccionar foto</label>
            <input id="photo_perfil_input" class="d-none" type="file" name="photo_url">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
