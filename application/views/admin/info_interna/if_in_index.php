      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Informacion Interna</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
                <li class="breadcrumb-item active">Informacion Interna</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <div class="my-2">
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

        <?php $this->load->view("admin/components/alert"); ?>
      </div>

      <!-- Main content -->
      <section class="content">

        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Informacion De La Empresa</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body ">
                <div class="table-responsive">

                  <form action="<?php echo $url_form_info_interna ?>" method="POST" id="form_informacion_interna">
                    <div class="row m-0">

                      <!-- nombre de la empresa -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="nombre_empresa">Nombre De La Empresa</label>
                          <input id="nombre_empresa" class="form-control <?php echo isset($informacion_interna->nombre_empresa) ? "input_transparent_update" : "" ?>" type="text" placeholder="Nombre De La Empresa" name="nombre_empresa" value="<?php echo isset($informacion_interna->nombre_empresa) ? $informacion_interna->nombre_empresa : "" ?>">
                        </div>
                      </div>

                      <!-- Direccion de la empresa -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="direccion_empresa">Direccion De La Empresa</label>
                          <input id="direccion_empresa" class="form-control <?php echo isset($informacion_interna->nombre_empresa) ? "input_transparent_update" : "" ?>" type="text" placeholder="Direccion De La Empresa" name="direccion_empresa" value="<?php echo isset($informacion_interna->direccion_empresa) ? $informacion_interna->direccion_empresa : "" ?>">
                        </div>
                      </div>

                      <!-- Telefono de la empresa -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="telefono_empresa">Telefono De La Empresa</label>
                          <input id="telefono_empresa" class="form-control <?php echo isset($informacion_interna->nombre_empresa) ? "input_transparent_update" : "" ?>" type="tel" placeholder="Telefono De La Empresa" name="telefono_empresa" value="<?php echo isset($informacion_interna->telefono_empresa) ? $informacion_interna->telefono_empresa : "" ?>" data-inputmask="'mask': ['999-999-9999 [x99999]', '+99 999 99999[9]9']" data-mask>
                        </div>
                      </div>

                      <!-- Correo de la empresa -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="email_empresa">Correo De La Empresa</label>
                          <input id="email_empresa" class="form-control <?php echo isset($informacion_interna->nombre_empresa) ? "input_transparent_update" : "" ?>" type="text" placeholder="Correo De La Empresa" name="email_empresa" value="<?php echo isset($informacion_interna->email_empresa) ? $informacion_interna->email_empresa : "" ?>">
                        </div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary btn-sm float-right" type="submit">Registrar</button>
                      </div>

                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>


          <div class="col-md-7">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Carteras De Pago</h3>

                <div class="card-tools">
                  <button class="btn btn-primary btn-sm" type="button" data-titulo="Nueva cartera" data-toggle="modal" data-target="#nueva_cartera">Nueva cartera</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table_data_tr table-striped table-valign-middle table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Actualizado</th>
                        <th>Creacion</th>
                        <th>acciones</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php foreach ($carteras as $i => $cartera) : ?>
                        <tr>
                          <td><?php echo $i + 1 ?></td>
                          <td><?php echo $cartera->id ?></td>
                          <td><?php echo $cartera->nombre ?></td>
                          <td><?php echo $cartera->email ?></td>
                          <td><?php echo $cartera->updated_at ?></td>
                          <td><?php echo $cartera->created_at ?></td>
                          <td>


                            <form action="<?php echo site_url("admin/carteras/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el cartera '+ '<?php echo $cartera->nombre ?>')">
                              <input type="hidden" value="<?php echo $cartera->id ?>" name="id">
  
                              <button class="btn btn-warning btn-sm" type="button" data-titulo="Editar cartera '<?php echo $cartera->nombre ?>'" data-toggle="modal" data-target="#nueva_cartera" data-id="<?php echo $cartera->id ?>">
                                <i class="fas fa-edit"></i>
                              </button>
  
                              <!-- <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash"></i>
                              </button> -->
                            </form>
                            
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-5">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Categorias</h3>

                <div class="card-tools">
                  <button class="btn btn-primary btn-sm" type="button" data-titulo="Nueva categoria" data-toggle="modal" data-target="#nueva_categoria">Nueva categoria</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table_data_tr table_data_tr table-striped table-valign-middle table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Actualizado</th>
                        <th>Creacion</th>
                        <th>acciones</th>
                      </tr>
                    </thead>


                    <tbody>

                      <?php foreach ($categorias as $i => $categoria) : ?>
                        <tr>
                          <td><?php echo $i + 1 ?></td>
                          <td><?php echo $categoria->id ?></td>
                          <td><?php echo $categoria->nombre ?></td>
                          <td><?php echo $categoria->updated_at ?></td>
                          <td><?php echo $categoria->created_at ?></td>
                          <td>
                            <form action="<?php echo site_url("admin/categorias/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el categoria '+ '<?php echo $categoria->nombre ?>')">
                              <input type="hidden" value="<?php echo $categoria->id ?>" name="id">

                              <button class="btn btn-warning btn-sm" type="button" data-titulo="Editar categoria '<?php echo $categoria->nombre ?>'" data-toggle="modal" data-target="#nueva_categoria" data-id="<?php echo $categoria->id ?>">
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
                </div>
                <!-- /.table-responsive -->
              </div>

            </div>
          </div>



        </div>

      </section>
      <!-- /.content -->


      <!-- modal carteras -->
      <div id="nueva_cartera" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_cartera" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title_modalnuevo_cartera"></h5>
              <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form action="<?php echo site_url("admin/carteras/crear") ?>" method="POST" enctype="multipart/form-data" id="form_cartera">

                <input type="hidden" value="0" name="id_cartera_input" id="id_cartera_input">

                <div class="row">

                  <!-- nombre -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nombre_cartera_name">Nombre</label>
                      <input id="nombre_cartera_name" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                  </div>

                  <!-- Correo Electronico -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email_cartera">Correo Electronico</label>
                      <input id="email_cartera" class="form-control " type="email" name="email" placeholder="Correo Electronico">
                    </div>
                  </div>

                </div>

                <button class="btn btn-primary float-right" type="submit">Registrar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- modal categorias -->
      <div id="nueva_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_categoria" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="title_modalnuevo_categoria"></h5>
              <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form action="<?php echo site_url("admin/categorias/crear") ?>" method="POST" enctype="multipart/form-data" id="form_categoria">

                <input type="hidden" value="0" name="id_categoria_input" id="id_categoria_input">

                <div class="row">

                  <!-- nombre -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nombre_categoria_name">Nombre</label>
                      <input id="nombre_categoria_name" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary float-right" type="submit">Registrar</button>
              </form>
            </div>
          </div>
        </div>
      </div>