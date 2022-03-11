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
      							<button id="drop_config" class="btn btn-outline-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      								<i class="fas fa-bars fa-fw" style="color: var(--fa-navy);"></i>
      							</button>
      							<div class="dropdown-menu" aria-labelledby="drop_config">
      								<a class="dropdown-item dropdown-left" href="<?php echo site_url("admin_cliente_arabe/configuracion")?>">Configuracion</a>
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
      								<th>Acciones</th>
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($clientes as $i => $cliente) : ?>

      								<tr>
      									<td><?php echo $i + 1 ?></td>
      									<td><?php echo $cliente->id ?></td>
      									<td><?php echo $cliente->nombre ?></td>
      									<td style="width: 50px;">
      										<form action="<?php echo site_url("admin/clientes/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el cliente '+ '<?php echo $cliente->nombre ?>')">
      											<input type="hidden" value="<?php echo $cliente->id ?>" name="id">
      											<?php if ($this->session->userdata("perfil") == "administrador" or $this->session->userdata("perfil") == "editor") : ?>

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
      								<th>Acciones</th>
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($clientes as $i => $cliente) : ?>

      								<tr>
      									<td><?php echo $i + 1 ?></td>
      									<td><?php echo $cliente->id ?></td>
      									<td><?php echo $cliente->nombre ?></td>
      									<td style="width: 50px;">
      										<form action="<?php echo site_url("admin/clientes/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el cliente '+ '<?php echo $cliente->nombre ?>')">
      											<input type="hidden" value="<?php echo $cliente->id ?>" name="id">
      											<?php if ($this->session->userdata("perfil") == "administrador" or $this->session->userdata("perfil") == "editor") : ?>

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

      		<!-- Registros semanales -->
      		<div class="col-lg-4 col-md-12">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Registros</h3>

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
