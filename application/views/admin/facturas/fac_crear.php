<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>
          <?php echo isset($titulo) ? $titulo : "Nueva Factura" ?>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
          <li class="breadcrumb-item active">Factura</li>
          <li class="breadcrumb-item active">Nueva Factura</li>
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
      <h3 class="card-title">Nueva Factura</h3>


    </div>
    <div class="card-body">
      <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

      <?php $this->load->view("admin/components/alert"); ?>

      <div class="row">

        <!-- Formulario -->
        <div class="col-lg-8">
          <form target="_blanck" action="<?php echo site_url("admin/facturas/crear") ?>" method="POST" id="form_nueva_factura">
            <div class="row m-0">
              <input type="hidden" name="id_factura" value="<?php echo isset($factura->id) ? $factura->id : "0" ?>">

              <input type="hidden" name="id_informacion_interna" value="<?php echo $informacion_interna->id ?>">

              <!-- Nombre de la empresa -->
              <!-- <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="nombre_empresa">Nombre de la empresa</label>
                  <input disabled style="background: #4d4d4d;" id="nombre_empresa" placeholder="Nombre de la empresa" class="form-control" type="text" name="nombre_empresa" value="<?php echo isset($informacion_interna->nombre_empresa) ? $informacion_interna->nombre_empresa : "" ?>">
                </div>
              </div> -->

              <!-- direccion de la empresa -->
              <!-- <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="direccion_empresa">Direccion de la empresa</label>
                  <input disabled style="background: #4d4d4d;" id="direccion_empresa" placeholder="Direccion de la empresa" class="form-control" type="text" name="direccion_empresa" value="<?php echo isset($informacion_interna->direccion_empresa) ? $informacion_interna->direccion_empresa : "" ?>">
                </div>
              </div> -->

              <!-- telefono de la empresa -->
              <!-- <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="telefono_empresa">Telefono de la empresa</label>
                  <input disabled style="background: #4d4d4d;" id="telefono_empresa" placeholder="Telefono de la empresa" class="form-control" type="text" name="telefono_empresa" value="<?php echo isset($informacion_interna->telefono_empresa) ? $informacion_interna->telefono_empresa : "" ?>">
                </div>
              </div> -->

              <!-- email de la empresa -->
              <!-- <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="email_empresa">Email de la empresa</label>
                  <input disabled style="background: #4d4d4d;" id="email_empresa" placeholder="Email de la empresa" class="form-control" type="email" name="email_empresa" value="<?php echo isset($informacion_interna->email_empresa) ? $informacion_interna->email_empresa : "" ?>">
                </div>
              </div> -->

              <!-- cliente dirigido -->
              <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="cliente">Cliente</label>
                  <select required id="cliente" class="select2 form-control" name="cliente">
                    <option value="">-- Seleccionar Cliente --</option>

                    <?php foreach ($clientes as $cliente) : ?>

                      <option <?php echo (isset($factura) and $factura->id_cliente == $cliente->id) ? "selected" : "" ?> value="<?php echo $cliente->id ?>"><?php echo $cliente->nombre ?></option>

                    <?php endforeach ?>

                  </select>
                </div>
              </div>

              <!-- Cartera de pago -->
              <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="cartera">Metodo De Pago</label>
                  <select required id="cartera" class="select2 form-control" name="cartera">
                    <option value="">-- Seleccionar Cartera --</option>

                    <?php foreach ($carteras as $cartera) : ?>

                      <option <?php echo (isset($factura) and $factura->id_cartera == $cartera->id) ? "selected" : "" ?> value="<?php echo $cartera->id ?>"><?php echo $cartera->nombre ?></option>

                    <?php endforeach ?>

                  </select>
                </div>
              </div>

              <!-- Job Services -->
              <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label for="job_services">
                    servicios de trabajo</label>
                  <input id="job_services" placeholder="servicios de trabajo" class="form-control" type="text" name="job_services" value="Desing Services">
                </div>
              </div>

              <!-- Check guardar factura estatica -->
              <div class="col-lg-3 col-6 col-md-4">
                <div class="form-group">
                  <label>Factura</label>
                  <div class="form-group clearfix m-0 p-2">
                    <?php if (!isset($factura)) : ?>
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" value="1" name="plantilla_factura" id="check_plantilla">
                        <label for="check_plantilla">Guardar Plantilla De Factura</label>
                      </div>
                      <?php else : ?>
                        
                      <div class="text-muted">Guardado Como Plantilla</div>

                    <?php endif ?>
                  </div>
                </div>
              </div>




              <div class="col-12 col-md-12">
                <label for="">Categorias Seleccionadas</label>

                <table class="table table-valign-middle">

                  <thead>
                    <tr>
                      <th>Categoria</th>
                      <th>Cantidad</th>
                      <th>Costo</th>
                      <th>Total Costo</th>
                      <th>#</th>
                    </tr>

                    <tr id="element_sin_items_categorias" class="<?php echo (isset($factura) AND (isset( $servicios ) AND count($servicios))) ? "d-none" : "" ?>">
                      <th></th>
                      <th></th>
                      <th class="text-center text-muted">
                        No hay categorias seleccionadas
                      </th>
                      <th></th>
                      <th></th>
                    </tr>


                  </thead>

                  <tbody id="insert_categoria_seleccionada">

                    <?php if (isset($servicios)) : ?>
                      <?php foreach ($servicios as $servicio) : ?>

                        <tr data-id="<?php echo $servicio->categoria_id ?>" class="alert fade show" id="categoria_select_<?php echo $servicio->categoria_id ?>">
                          <td>
                            <?php echo $servicio->nombre_categoria ?>
                          </td>
                          <td>
                            <div class="form-group m-0">
                              <input step="any" value="<?php echo $servicio->cantidad ?>" data-id="<?php echo $servicio->categoria_id ?>" placeholder="Cantidad" class="form-control cantidad_sercios_inputs" type="number" name="cantidad_servicios[<?php echo $servicio->categoria_id ?>]" min="0">
                            </div>
                          </td>
                          <td>
                            <div class="input-group m-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input required value="<?php echo $servicio->precio ?>" id="precio_<?php echo $servicio->categoria_id ?>" placeholder="$...." class="form-control input_cantidad_categoria" type="number" min="0" name="precio[<?php echo $servicio->categoria_id ?>]">
                            </div>
                          </td>
                          <td>
                            <div class="input-group m-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input disabled id="total_precio_<?php echo $servicio->categoria_id ?>" value="<?php echo $servicio->precio * $servicio->cantidad  ?>" placeholder="$...." class="form-control" style="background: #4d4d4d;" type="number" min="0">
                            </div>

                          </td>
                          <td>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </td>
                        </tr>

                      <?php endforeach ?>
                    <?php endif ?>


                  </tbody>

                  <tfoot>
                    <tr id="tfoot_total" class="<?php echo (isset($factura) AND (isset( $servicios ) AND count($servicios) > 0)) ? "d-table-row" : "" ?> d-none">
                      <th>Total:</th>
                      <th>
                        <div class="form-group">
                          <input disabled placeholder="Cantidad Total" id="cantidad_servicio_total" class="form-control" type="number" min="1" style="background: #4d4d4d;" value="<?php echo isset($servicios_total) ? $servicios_total->total_cantidad : "" ?>">
                        </div>
                      </th>
                      <th>
                        <div class="d-none input-group m-0">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input disabled value="0" id="input_total" class="form-control" style="background: #4d4d4d;" type="number" min="1">
                        </div>
                      </th>
                      <th>
                        <div class="input-group">
                          <!-- <label for="final_cantidad">Text</label> -->
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input disabled id="input_total_precios_all" value="<?php echo isset($servicios_total) ? $servicios_total->total_pago : "0" ?>" class="form-control" style="background: #4d4d4d;" type="number" min="1">
                        </div>
                      </th>
                      <th></th>
                    </tr>
                  </tfoot>


                </table>

              </div>


            </div>
          </form>

        </div>

        <!-- vategorias -->
        <div class="col-lg-4">
          <label for="">Categorias</label>

          <table class="table table-valign-middle">

            <?php foreach ($categorias as $key => $categoria) : ?>

              <tr>

                <td style="width: 20px;">
                  <div class="form-group clearfix m-0">
                    <div class="icheck-primary d-inline">
                      <input <?php echo (isset($id_categorias) and in_array($categoria->id, $id_categorias)) ? "checked" : "" ?> type="checkbox" value="1" data-id="<?php echo $categoria->id ?>" data-nombre="<?php echo $categoria->nombre ?>" class="check_categoria" name="" id="check_categoria_<?php echo $categoria->id ?>">
                      <label for="check_categoria_<?php echo $categoria->id ?>"></label>
                    </div>
                  </div>
                </td>
                <td>
                  <label for="check_categoria_<?php echo $categoria->id ?>" class="text-left btn btn-light btn-sm border-0 bg-transparent text-light btn-block">
                    <?php echo $categoria->nombre ?>
                  </label>
                </td>
                <!-- <td>dsads</td> -->
              </tr>

            <?php endforeach  ?>

          </table>


        </div>
      </div>

    </div>
    <div class="card-footer">
      <button class="float-right btn btn-primary" type="submit" form="form_nueva_factura">Crear Factura</button>
    </div>
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
