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

      							<a href="<?php echo site_url("admin_cliente_arabe/vista_creacion_registro") ?>" class="btn mr-1 btn-outline-light btn-sm">Nuevo Reporte</a>

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


      		<div class="col-lg-3 col-md-6">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Empleados</h3>

      					<div class="card-tools">
      						<!-- <button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo cliente" data-toggle="modal" data-target="#nuevo_cliente">Nuevo cliente</button> -->
      					</div>
      				</div>
      				<div class="card-body">


      					<!-- tabla de Clientes -->
      					<table class="table table-striped table-valign-middle">
      						<thead class="">
      							<tr>
      								<th>#</th>
      								<!-- <th>ID</th> -->
      								<th>Nombre</th>
      								<!-- <th>Acciones</th> -->
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($this->empleados_arabe as $i => $empleado) : ?>

      								<tr id="empleado_id_<?php echo $empleado->id ?>">
      									<td><?php echo $i + 1 ?></td>
      									<!-- <td><?php echo $empleado->id ?></td> -->
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
      		<div class="col-lg-3 col-md-6">
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
      								<!-- <th>ID</th> -->
      								<th>Nombre</th>
      								<!-- <th>Acciones</th> -->
      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($this->servicios_arabe as $i => $servicio) : ?>

      								<tr id="servicio_id_<?php echo $servicio->id ?>">
      									<td><?php echo $i + 1 ?></td>
      									<!-- <td><?php echo $servicio->id ?></td> -->
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
      		<div class="col-lg-6 col-md-12">
      			<div class="card">
      				<div class="card-header">
      					<h3 class="card-title">Reporte</h3>

      					<div class="card-tools">
      						<a href="<?php echo site_url("admin_cliente_arabe/historial_reportes") ?>" class="btn btn-info btn-sm">Ver Historial</a>
      						<button form="form_reportes_select" id="submit_button_reportes_select" class="btn btn-primary btn-sm" type="submit" disabled>Ver Reporte</button>
      					</div>
      				</div>
      				<div class="card-body">

      					<?php if (count($reportes) > 0) : ?>

      						<form action="<?php echo site_url("admin_cliente_arabe/vista_reporte/") ?>" id="form_reportes_select" method="GET">
      							<form></form>
      							<table class="table  table-striped table-valign-middle">
      								<thead class="">
      									<tr>
      										<th>#</th>
      										<th>ID</th>
      										<th>Facturado</th>
      										<th>Creacion</th>
      										<th>Acciones</th>
      									</tr>
      								</thead>
      								<tbody>

      									<?php foreach ($reportes as $i => $reporte) : ?>


      										<tr>
      											<td>

      												<div class="form-group clearfix m-0">
      													<div class="icheck-primary d-inline">
      														<input type="checkbox" class="input_reporte_check" value="<?php echo $reporte->id ?>" name="ids_reportes[<?php echo $reporte->id ?>]" id="check_reporte_<?php echo $reporte->id ?>">
      														<label for="check_reporte_<?php echo $reporte->id ?>"></label>
      													</div>
      												</div>

      											</td>

      											<td><?php echo $reporte->id ?></td>
      											<td>

      												<a onclick="return confirm('¿Realmente deseas <?php echo ($reporte->reporte_facturado_bool == 1) ? 'eliminarle' : 'Agregarle' ?> la facturacion al reporte?')" href="<?php echo site_url("admin/cliente_arabe/actualizar_facturacion_reporte/" . $reporte->id) ?>">
      													<span class="badge badge-<?php echo $reporte->reporte_facturado_color ?>">
      														<?php echo $reporte->reporte_facturado ?>
      													</span>
      												</a>


      											</td>

      											<td>
      												<span data-fecha="<?php echo $reporte->timestamp_created_at ?>" class="moment_format"><?php echo $reporte->created_at ?></span>
      											</td>

      											<td style="width: 150px;">

      												<form action="<?php echo site_url("admin/cliente_arabe/eliminar_reporte/" . $reporte->id) ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el reporte ?')">
      													<input type="hidden" value="<?php echo $reporte->id ?>" name="id">
      													<?php if ($this->session->userdata("perfil") == "administrador" or $this->session->userdata("perfil") == "editor") : ?>


      														<a href="<?php echo site_url("admin_cliente_arabe/vista_reporte/?ids_reportes[$reporte->id]=$reporte->id") ?>" class="btn btn-info btn-sm">
      															<i class="fas fa-file-pdf"></i>
      														</a>
      														<a href="<?php echo site_url("admin_cliente_arabe/vista_reporte_actualizar/$reporte->id") ?>" class="btn btn-warning btn-sm">
      															<i class="fas fa-edit"></i>
      														</a>

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

      						</form>

      					<?php else : ?>
      						<div class="text-center text-muted">No gay reportes registrados</div>
      					<?php endif ?>
      					<!-- tabla de Clientes -->

      					<!-- tabla de reportes end -->




      				</div>
      			</div>
      		</div>

      	</div>

      	<!-- Default box -->
      	<!-- /.card -->

      </section>
      <!-- /.content -->
