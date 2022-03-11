      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Configuracion Del Modulo</h1>
      			</div>
      			<div class="col-sm-6">
      				<ol class="breadcrumb float-sm-right">
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_cliente_arabe") ?>">Registro Arabe</a></li>
      					<li class="breadcrumb-item active">Configuracion Del Modulo</li>
      				</ol>
      			</div>
      		</div>
      	</div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

      	<?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

      	<?php $this->load->view("admin/components/alert"); ?>

      	<div class="col-md-12">
      		<div class="card">
      			<div class="card-header">
      				<h3 class="card-title">Configuracion</h3>
      			</div>
      			<div class="card-body">
      				<form action="">
      					<div class="row">

      						<!-- empleados -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="">Empleados</label>
      								<div class="d-flex flex-wrap">
      									<?php foreach ($empleados as $empleado) : ?>

      										<div class="p-1">
      											<label class="btn mb-0 btn-outline-light ">
      												<div class="form-group clearfix m-0">
      													<div class="icheck-primary d-inline">
      														<input id="check_empl_<?php echo $empleado->id ?>" type="checkbox" value="<?php echo $empleado->id ?>" class="check_categoria" name="">
      														<label for="check_empl_<?php echo $empleado->id ?>"><?php echo $empleado->nombre ?></label>
      													</div>
      												</div>
      											</label>
      										</div>

      									<?php endforeach ?>
      								</div>
      							</div>
      						</div>

      						<!-- servicios -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="">Serviciox</label>

      								<div class="d-flex flex-wrap">
      									<?php foreach ($servicios as $servicio) : ?>

      										<div class="p-1">
      											<label class="btn mb-0 btn-outline-light ">
      												<div class="form-group clearfix m-0">
      													<div class="icheck-primary d-inline">
      														<input id="check_serv_<?php echo $servicio->id ?>" type="checkbox" value="<?php echo $servicio->id ?>" class="check_categoria" name="">
      														<label for="check_serv_<?php echo $servicio->id ?>"><?php echo $servicio->nombre ?></label>
      													</div>
      												</div>
      											</label>
      										</div>

      									<?php endforeach ?>
      								</div>
      							</div>
      						</div>
      					</div>

						  <div class="d-flex justify-content-end">
							  <button class="btn btn-primary" type="submit">Registrar</button>

						  </div>
      				</form>

      			</div>
      		</div>
      	</div>

      </section>
      <!-- /.content -->


      <div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_cliente" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="title_modalnuevo_cliente"></h5>
      				<button class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">

      				<form action="<?php echo site_url("admin/clientes/crear") ?>" method="POST" enctype="multipart/form-data" id="form_cliente">

      					<input type="hidden" value="0" name="id_cliente_input" id="id_cliente_input">

      					<div class="row">

      						<!-- nombre -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="nombre_cliente_name">Nombre</label>
      								<input id="nombre_cliente_name" class="form-control" type="text" name="nombre" placeholder="Nombre y Apellido">
      							</div>
      						</div>

      						<!-- nombre de La Empresa -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="nombre_empresa_cliente">Nombre De La Empresa</label>
      								<input id="nombre_empresa_cliente" class="form-control" type="text" name="nombre_empresa" placeholder="Nombre De La Empresa">
      							</div>
      						</div>

      						<!-- numero de telefono -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="numero_telefojo_cliente">Numero De Telefono</label>
      								<input id="numero_telefojo_cliente" class="form-control" type="tel" name="telefono" placeholder="Numero De Telefono" data-inputmask="'mask': ['999-999-9999 [x99999]', '+99 999 99999[9]9']" data-mask>
      							</div>
      						</div>


      						<!-- Correo Electronico -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="email_cliente">Correo Electronico</label>
      								<input id="email_cliente" class="form-control " type="email" name="email" placeholder="Correo Electronico">
      							</div>
      						</div>

      						<!-- <div class="col-md-6">

                  </div>
                  <div class="col-md-6">

                  </div> -->
      					</div>






      					<button class="btn btn-primary float-right" type="submit">Registrar</button>
      				</form>

      			</div>
      		</div>
      	</div>
      </div>
