      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Administrador De Empleados</h1>
      			</div>
      			<div class="col-sm-6">
      				<ol class="breadcrumb float-sm-right">
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
      					<li class="breadcrumb-item active">Administrador De Empleados</li>
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
      			<h3 class="card-title">Empleados</h3>

      			<div class="card-tools">
      				<button class="btn btn-primary btn-sm" type="button" data-titulo="Nuevo empleado" data-toggle="modal" data-target="#nuevo_empleado">Nuevo empleado</button>
      			</div>
      		</div>
      		<div class="card-body">
      			<?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

      			<?php $this->load->view("admin/components/alert"); ?>


      			<!-- tabla de empleados -->
      			<table class="table table_data_tr table-striped table-valign-middle">
      				<thead class="">
      					<tr>
      						<th>#</th>
      						<th>ID</th>
      						<th>Usuario</th>
      						<th>Nombre</th>
      						<th>Email</th>
      						<th>Cartera</th>
      						<th>ultima Modificacion</th>
      						<th>Creado</th>
      						<th>Acciones</th>
      					</tr>
      				</thead>
      				<tbody>

      					<?php foreach ($empleados as $i => $empleado) : ?>

      						<tr>
      							<td><?php echo $i + 1 ?></td>
      							<td><?php echo $empleado->id ?></td>
      							<td><?php echo $empleado->usuario_creacion ?></td>
      							<td><?php echo $empleado->nombre ?></td>
      							<td><?php echo $empleado->email ?></td>
      							<td><?php echo $empleado->cartera ?></td>
      							<td><?php echo $empleado->updated_at ?></td>
      							<td><?php echo $empleado->created_at ?></td>
      							<td>
      								<form action="<?php echo site_url("admin/empleados/eliminar") ?>" method="POST" onsubmit="return confirm('Realmente deseas eliminar el empleado '+ '<?php echo $empleado->nombre ?>')">
      									<input type="hidden" value="<?php echo $empleado->id ?>" name="id">
      									<?php if ($this->session->userdata("perfil") == "administrador" or $this->session->userdata("perfil") == "editor") : ?>
											
      										<button class="btn btn-warning btn-sm" type="button" data-titulo="Editar empleado '<?php echo $empleado->nombre ?>'" data-toggle="modal" data-target="#nuevo_empleado" data-id="<?php echo $empleado->id ?>">
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

      			<!-- tabla de empleados end -->




      		</div>
      	</div>
      	<!-- /.card -->

      </section>
      <!-- /.content -->


      <div id="nuevo_empleado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="title_modalnuevo_empleado" aria-hidden="true">
      	<div class="modal-dialog" role="document">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h5 class="modal-title" id="title_modalnuevo_empleado"></h5>
      				<button class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">

      				<form action="<?php echo site_url("admin/empleados/crear") ?>" method="POST" enctype="multipart/form-data" id="form_empleado">

      					<input type="hidden" value="0" name="id_empleado_input" id="id_empleado_input">

      					<div class="row">

      						<!-- nombre -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="nombre_empleado_name">Nombre</label>
      								<input id="nombre_empleado_name" class="form-control" type="text" name="nombre" placeholder="Nombre y Apellido">
      							</div>
      						</div>

      						<!-- Email -->
      						<div class="col-md-6">
      							<div class="form-group">
      								<label for="email_empleado">Email</label>
      								<input id="email_empleado" class="form-control" type="email" name="email" placeholder="Nombre De La Empresa">
      							</div>
      						</div>

      						<!-- Cartera -->
      						<div class="col-md-12">
      							<div class="form-group">
      								<label for="Cartera_empleado">Cartera</label>
									  
									  <select id="Cartera_empleado" class="form-control" name="cartera_id">
										  <option value="">-- Seleccionar Cartera --</option>
										  <?php foreach( $carteras AS $cartera ):?>
											<option value="<?php echo $cartera->id ?>"><?php echo $cartera->nombre ?></option>
										  <?php endforeach?>
									  </select>
									  
      							</div>
      						</div>
      					</div>

      					<button class="btn btn-primary float-right" type="submit">Registrar</button>
      				</form>

      			</div>
      		</div>
      	</div>
      </div>
