      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Administrador De Usuarios</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
                <li class="breadcrumb-item active">Administrador De Usuarios</li>
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
            <h3 class="card-title">Usuarios</h3>

            <div class="card-tools">
              <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo Usuario" data-toggle="modal" data-target="#nuevo_usuario">Nuevo Usuario</button>
            </div>
          </div>
          <div class="card-body">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

            <?php $this->load->view("admin/components/alert"); ?>


            <!-- tabla de usuarios -->
            <table class="table table_data_tr table-striped table-valign-middle table-hover">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>foto</th>
                  <th>Nombre</th>
                  <th>Nombre De Usuario</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>Ultimo Loggin</th>
                  <th>Creado</th>
                  <th>Aciiones</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach ($usuarios as $i => $usuario) : ?>

                  <tr style="<?php echo $usuario->id == $this->session->userdata("id") ? "background-color: #272727;" : ""?>" >
                    <td><?php echo $i + 1?></td>
                    <td><?php echo $usuario->id ?></td>
                    <td>
                      <img src="<?php echo base_url($usuario->foto) ?>" class="rounded-circle" width="40px" alt="">
                    </td>
                    <td><?php echo $usuario->nombre ?></td>
                    <td><?php echo $usuario->nombre_usuario ?></td>
                    <td><?php echo $usuario->perfil ?></td>
                    <td>
                      <form action="<?php echo site_url("admin/usuarios/activar") ?>" method="POST">
                        <input type="hidden" value="<?php echo $usuario->id ?>" name="id">
                        <input type="hidden" value="<?php echo $usuario->estado ?>" name="estado">

                        <button class="btn btn-sm btn-<?php echo $usuario->activado_color ?>" type="submit">
                          <?php echo $usuario->activado ?>
                        </button>
                      </form>
                    </td>
                    <td><?php echo $usuario->ultimo_login ?></td>
                    <td><?php echo $usuario->created_at ?></td>
                    <td>
                      <form action="<?php echo site_url("admin/usuarios/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el usuario '+ '<?php echo $usuario->nombre_usuario ?>')">
                        <input type="hidden" value="<?php echo $usuario->id ?>" name="id">
                        
                          <button class="btn btn-warning btn-sm" type="button" data-titulo="Editar Usuario '<?php echo $usuario->nombre_usuario ?>'" data-toggle="modal" data-target="#nuevo_usuario" data-id="<?php echo $usuario->id ?>">
                            <i class="fas fa-edit"></i>
                          </button>

                          <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fas fa-trash"></i>
                          </button>
                        
                      </form>
                    </td>
                  </tr>

                <?php endforeach; ?>

              </tbody>
            </table>

            <!-- tabla de usuarios end -->




          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->


      <div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_usuario" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title_modalnuevo_usuario"></h5>
              <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form action="<?php echo site_url("admin/usuarios/crear") ?>" method="POST" enctype="multipart/form-data" id="form_usuario">

                <input type="hidden" value="0" name="id_usuario_input" id="id_usuario_input">

                <!-- nombre -->
                <div class="form-group">
                  <label for="nombre_usuario_name">Nombre</label>
                  <input id="nombre_usuario_name" class="form-control" type="text" name="nombre" placeholder="Nombre y Apellido">
                </div>

                <!-- nombre de usuario -->
                <div class="form-group">
                  <label for="nombre_de_usuatio_usuario">Nombre De Usuario</label>
                  <input id="nombre_de_usuatio_usuario" class="form-control" type="text" name="nombre_usuario" placeholder="Nombre De Usuario">
                </div>

                <!-- perfil -->
                <div class="form-group">
                  <label for="perfil_usuario">Perfil</label>
                  <select name="perfil" id="perfil_usuario" class="form-control">
                    <option value="">-- Seleccionar Perfil --</option>
                    <option value="administrador">Administrador</option>
                    <option value="editor">Editor</option>
                    <option value="trabajador">Trabajador</option>
                  </select>
                </div>

                <!-- contraseña -->
                <div class="form-group">
                  <label for="contraseña_usuario">Contraseña</label>
                  <input id="contraseña_usuario" class="form-control" type="password" name="password" placeholder="Contraseña">
                </div>

                <!-- foto -->
                <div class="form-group">
                  <label for="foto_usuario">Subir Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="foto_usuario" name="foto">
                      <label class="custom-file-label" for="foto_usuario">Subir Foto</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Archivo</span>
                    </div>
                  </div>
                </div>

                <button class="btn btn-primary float-right" type="submit">Registrar</button>
              </form>

            </div>
          </div>
        </div>
      </div>