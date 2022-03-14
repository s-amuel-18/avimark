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
      				<form action="<?php echo site_url("admin/cliente_arabe/crear_configuracion") ?>" method="POST" id="form_cli_arabe_config">
      					<div class="row">

      						<!-- empleados -->
      						<div class="col-md-5">
      							<div class="form-group">
      								<label for="">Empleados</label>
      								<div class="d-flex flex-wrap">
      									<?php foreach ($empleados as $empleado) : ?>

      										<div class="p-1">
      											<label class="btn mb-0 btn-outline-light ">
      												<div class="form-group clearfix m-0">
      													<div class="icheck-primary d-inline">
      														<input <?php echo $empleado->check == 1 ? "checked" : "" ?> id="check_empl_<?php echo $empleado->id ?>" type="checkbox" value="<?php echo $empleado->id ?>" class="check_empleados" value="<?php echo $empleado->id ?>" name="empleados[<?php echo $empleado->id ?>]">
      														<label for="check_empl_<?php echo $empleado->id ?>"><?php echo $empleado->nombre ?></label>
      													</div>
      												</div>
      											</label>
      										</div>

      									<?php endforeach ?>
      									<!-- <input type="text" value="1" name="sss"> -->

      								</div>
      							</div>
      						</div>

      						<!-- servicios -->
      						<div class="col-md-5">
      							<div class="form-group">
      								<label for="">Serviciox</label>

      								<div class="d-flex flex-wrap">
      									<?php foreach ($servicios as $servicio) : ?>

      										<div class="p-1">
      											<label class="btn mb-0 btn-outline-light ">
      												<div class="form-group clearfix m-0">
      													<div class="icheck-primary d-inline">
      														<input <?php echo $servicio->check == 1 ? "checked" : "" ?> id="check_serv_<?php echo $servicio->id ?>" type="checkbox" value="<?php echo $servicio->id ?>" value="<?php echo $servicio->id ?>" class="check_servicios" name="servicios[<?php echo $servicio->id ?>]">
      														<label for="check_serv_<?php echo $servicio->id ?>"><?php echo $servicio->nombre ?></label>
      													</div>
      												</div>
      											</label>
      										</div>

      									<?php endforeach ?>
      								</div>
      							</div>
      						</div>

      						<!-- Clientes -->
      						<div class="col-md-2">
      							<div class="form-group">
      								<label for="cliente">Clientes</label>

									  <select class="form-control" name="cliente_id" id="cliente">
										  <option value="">-- Seleccionar Cliente --</option>
										  <?php foreach ($clientes as $cliente) : ?>	

											<option <?php echo $cliente->check == 1 ? "selected" : "" ?> value="<?php echo $cliente->id?>"><?php echo $cliente->nombre?></option>
											
										  <?php endforeach ?>
									  </select>
									  
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
