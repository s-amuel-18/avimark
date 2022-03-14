      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Gestor De actividad</h1>
      			</div>
      			<div class="col-sm-6">
      				<ol class="breadcrumb float-sm-right">
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
      					<li class="breadcrumb-item active">Gestor De actividad</li>
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


      	<div class="row">

      		<!-- Configuracionsection -->
      		<div class="col-md-12">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Herramientas</h3>

      					<div class="card-tools">

      						<div class="dropdown dropleft">

      							<a href="<?php echo site_url("admin_cliente_arabe/vista_creacion_registro")?>" class="btn mr-1 btn-outline-light btn-sm">Nuevo Reporte</a>

      							<button id="drop_config" class="btn btn-outline-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      								<i class="fas fa-bars fa-fw" style="color: var(--fa-navy);"></i>
      							</button>
      							<div class="dropdown-menu" aria-labelledby="drop_config">
      								<a class="dropdown-item dropdown-left" href="<?php echo site_url("admin_cliente_arabe/configuracion") ?>">Configuracion</a>
      							</div>
      						</div>
      					</div>
      				</div>


      			</div>
      		</div>


      		<div class="col-lg-4 col-md-6">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Empleados</h3>

      					<div class="card-tools">
      						<!-- <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo cliente" data-toggle="modal" data-target="#nuevo_cliente">Nuevo cliente</button> -->
      					</div>
      				</div>
      				<div class="card-body">


      					<!-- tabla de Clientes -->
      					<table class="table  table-striped table-valign-middle">
      						<thead class="">
      							<tr>
      								<th>#</th>
      								<th>ID</th>
      								<th>Nombre</th>
      								<!-- <th>Acciones</th> -->
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($this->empleados_arabe as $i => $empleado) : ?>

      								<tr>
      									<td><?php echo $i + 1 ?></td>
      									<td><?php echo $empleado->id ?></td>
      									<td><?php echo $empleado->nombre ?></td>

      								</tr>

      							<?php endforeach; ?>

      						</tbody>
      					</table>

      					<!-- tabla de Clientes end -->




      				</div>
      			</div>
      		</div>

      		<!-- servicios -->
      		<div class="col-lg-4 col-md-6">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Servicios</h3>

      					<div class="card-tools">
      						<!-- <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo cliente" data-toggle="modal" data-target="#nuevo_cliente">Nuevo cliente</button> -->
      					</div>
      				</div>
      				<div class="card-body">
      					<!-- tabla de Clientes -->
      					<table class="table  table-striped table-valign-middle">
      						<thead class="">
      							<tr>
      								<th>#</th>
      								<th>ID</th>
      								<th>Nombre</th>
      								<!-- <th>Acciones</th> -->
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($this->servicios_arabe as $i => $servicio) : ?>

      								<tr>
      									<td><?php echo $i + 1 ?></td>
      									<td><?php echo $servicio->id ?></td>
      									<td><?php echo $servicio->nombre ?></td>
      								</tr>

      							<?php endforeach; ?>

      						</tbody>
      					</table>

      					<!-- tabla de Clientes end -->




      				</div>
      			</div>
      		</div>

      		<!-- Registros semanales -->
      		<div class="col-lg-4 col-md-12">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Reporte</h3>

      					<div class="card-tools">
      						<!-- <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo cliente" data-toggle="modal" data-target="#nuevo_cliente">Nuevo cliente</button> -->
      					</div>
      				</div>
      				<div class="card-body">
      					<!-- tabla de Clientes -->
      					<table class="table table_data_tr table-striped table-valign-middle">
      						<thead class="">
      							<tr>
      								<th>#</th>
      								<th>ID</th>
      								<th>Nombre</th>
      								<th>Acciones</th>
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($clientes as $i => $cliente) : ?>

      								<tr>
      									<td><?php echo $i + 1 ?></td>
      									<td><?php echo $cliente->id ?></td>
      									<td><?php echo $cliente->nombre ?></td>
      									<td style="width: 120px;">
      										<form action="<?php echo site_url("admin/clientes/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el cliente '+ '<?php echo $cliente->nombre ?>')">
      											<input type="hidden" value="<?php echo $cliente->id ?>" name="id">
      											<?php if ($this->session->userdata("perfil") == "administrador" or $this->session->userdata("perfil") == "editor") : ?>

      												<a href="" class="btn btn-info btn-sm">
      													<!-- <i class="fas fa-arrow-up-right-from-square fa-fw" style="color: var(--fa-navy);"></i> -->
      													<!-- <i class="fas fa-up-right-from-"></i> -->
      													<!-- <i class="fas fa-arrow-right-from-bracket " style="color: var(--fa-navy);"></i> -->
      													<!-- <i class="fas fa-arrow-right-to-bracket fa-fw" style="color: var(--fa-navy);"></i> -->
      													<!-- <i class="fas fa-circle-arrow-right fa-fw" style="color: var(--fa-navy);"></i> -->
      													<i class="fas fa-file-pdf"></i>
      												</a>

      												<button class="btn btn-warning btn-sm" type="button" data-titulo="Editar cliente '<?php echo $cliente->nombre ?>'" data-toggle="modal" data-target="#nuevo_cliente" data-id="<?php echo $cliente->id ?>">
      													<i class="fas fa-edit"></i>
      												</button>

      												<button class="btn btn-danger btn-sm" type="submit">
      													<i class="fas fa-trash"></i>
      												</button>
      											<?php endif ?>
      										</form>
      									</td>
      								</tr>

      							<?php endforeach; ?>

      						</tbody>
      					</table>

      					<!-- tabla de Clientes end -->




      				</div>
      			</div>
      		</div>

      	</div>

      	<!-- Default box -->
      	<!-- /.card -->

      </section>
      <!-- /.content -->
