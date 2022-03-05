<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Administrador De Emails</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
          <li class="breadcrumb-item active">Administrador De Emails</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Emails</h3>

      <div class="card-tools">
        <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo email" data-toggle="modal" data-target="#nuevo_email_contacto">Nuevo email</button>
      </div>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-md-9">

          <div class="row">
            <?php
            $this->load->view("admin/components/card-headers", ["items" => $emails_registrados_epoca]);
            ?>
          </div>
        </div>
      </div>


      <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

      <?php $this->load->view("admin/components/alert"); ?>


      <!-- tabla de emails_contacto -->
      <table class="table table-striped table-valign-middle table-hover" id="emails_tr">
        <thead class="">
          <tr>
            <th>#</th>
            <th>ID</th>
            <th>Usuario</th>
            <th>Categoria</th>
            <th>Nombre</th>
            <th>email</th>
            <th>Enviado</th>
            <th>ultima Modificacion</th>
            <th>Creado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="td_center">



        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->


<div id="nuevo_email_contacto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_email_contacto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modalnuevo_email_contacto"></h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?php echo site_url("admin/emails_contacto/crear") ?>" method="POST" enctype="multipart/form-data" id="form_email_contacto">

          <input type="hidden" value="0" name="id_email_input" id="id_email_input">

          <div class="row">

            <!-- nombre -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="nombre_email_contacto_name">Nombre</label>
                <input id="nombre_email_contacto_name" class="form-control" type="text" name="nombre" placeholder="Nombre">
              </div>
            </div>

            <!-- nombre de La Empresa -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="url_email_contacto">Url De La Pagina</label>
                <input id="url_email_contacto" class="form-control" type="text" name="url" placeholder="Url De La Pagina">
              </div>
            </div>

            <!-- Correo Electronico -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="email_email_contacto">Correo Electronico</label>
                <input id="email_email_contacto" class="form-control " type="email" name="email" placeholder="Correo Electronico">
              </div>
            </div>

            <!-- Correo Electronico -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="categorias_email_contacto">Categoria_id</label>

                <?php if (count($categorias) < 1) : ?>

                  <input type="text" class="form-control" disabled value="No Hay Categorias Registradas">
                <?php else : ?>
                  <select class="form-control" name="categoria_id" id="categoria_id">
                    <option value="">-- Seleccionar Categoria --</option>
                    <?php foreach ($categorias as $categoria) : ?>
                      <option value="<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></option>
                    <?php endforeach ?>
                  </select>
                <?php endif ?>

              </div>
            </div>

            <!-- Descripcion -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="email_email_contacto">Descripcion</label>
                <textarea id="email_email_contacto" class="form-control " name="descripcion" rows="5"></textarea>
              </div>
            </div>
          </div>

          <button class="btn btn-primary float-right" type="submit">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div>