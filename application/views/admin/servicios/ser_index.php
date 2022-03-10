      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Administrador De servicios</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
                <li class="breadcrumb-item active">Administrador De servicios</li>
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
            <h3 class="card-title">servicios</h3>

            <div class="card-tools">
              <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo servicio" data-toggle="modal" data-target="#nuevo_servicio">Nuevo servicio</button>
            </div>
          </div>
          <div class="card-body">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

            <?php $this->load->view("admin/components/alert"); ?>


            <!-- tabla de servicios -->
            <table class="table table_data_tr table-striped table-valign-middle">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Precio Total</th>
                  <th>Precio Empleado</th>
                  <th>Precio Empleado Mayor</th>
                  <th>ultima Modificacion</th>
                  <th>Creado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($servicios as $i => $servicio) : ?>

                  <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $servicio->id ?></td>
                    <td><?php echo $servicio->usuario_creacion ?></td>
                    <td><?php echo $servicio->nombre ?></td>
                    <td><?php echo number_format($servicio->precio_total, 2) ?></td>
                    <td><?php echo number_format($servicio->precio_empleado, 2) ?></td>
                    <td><?php echo $servicio->precio_empleado_mayor ? number_format($servicio->precio_empleado_mayor, 2) : "Sin Precio" ?></td>
                    <td><?php echo $servicio->updated_at ?></td>
                    <td><?php echo $servicio->created_at ?></td>
                    <td>
                      <form action="<?php echo site_url("admin/servicios/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el servicio '+ '<?php echo $servicio->nombre ?>')">
                        <input type="hidden" value="<?php echo $servicio->id ?>" name="id">
                        <?php if ( $this->session->userdata("perfil") == "administrador" OR $this->session->userdata("perfil") == "editor") : ?>
                        <button class="btn btn-warning btn-sm" type="button" data-titulo="Editar servicio '<?php echo $servicio->nombre ?>'" data-toggle="modal" data-target="#nuevo_servicio" data-id="<?php echo $servicio->id ?>">
                          <i class="fas fa-edit"></i>
                        </button>

                        <button class="btn btn-danger btn-sm" type="submit">
                          <i class="fas fa-trash"></i>
                        </button>
                        <?php endif?>
                      </form>
                    </td>
                  </tr>

                <?php endforeach; ?>

              </tbody>
            </table>

            <!-- tabla de servicios end -->




          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->


      <div id="nuevo_servicio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_servicio" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title_modalnuevo_servicio"></h5>
              <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form action="<?php echo site_url("admin/servicios/crear") ?>" method="POST" enctype="multipart/form-data" id="form_servicio">

                <input type="hidden" value="0" name="id_servicio_input" id="id_servicio_input">

                <div class="row">

                  <!-- nombre -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nombre_servicio_name">Nombre</label>
                      <input id="nombre_servicio_name" class="form-control" type="text" name="nombre" placeholder="Nombre y Apellido">
                    </div>
                  </div>

                  <!-- precio_total -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="precio_total_servicio_name">Precio Total</label>
                      <input id="precio_total_servicio_name" class="form-control" type="number" min="0" name="precio_total" placeholder="precio total">
                    </div>
                  </div>

                  <!-- precio_empleado -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="precio_empleado_servicio_name">Precio Empleado</label>
                      <input id="precio_empleado_servicio_name" class="form-control" type="number" min="0" name="precio_empleado" placeholder="precio Empleado">
                    </div>
                  </div>

                  <!-- precio_empleado_mayor -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="precio_empleado_mayor_servicio_name">Precio Empleado Mayor</label>
                      <input id="precio_empleado_mayor_servicio_name" class="form-control" type="number" min="0" name="precio_empleado_mayor" placeholder="precio Empleado Mayor">
                    </div>
                  </div>

                </div>






                <button class="btn btn-primary float-right" type="submit">Registrar</button>
              </form>

            </div>
          </div>
        </div>
      </div>
