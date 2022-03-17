      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Nuevo Reporte</h1>
      			</div>
      			<div class="col-sm-6">
      				<ol class="breadcrumb float-sm-right">
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_cliente_arabe") ?>">Actualizar</a></li>
      					<li class="breadcrumb-item active">Nuevo Reporte</li>
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
      					<h3 class="card-title">Actualizar Reporte</h3>
      				</div>

      				<div class="card-body">
      					<form action="<?php echo site_url("admin/cliente_arabe/actualizar_reporte/" .$id_reporte )?>" method="POST" id="form_reporte_arabe">
						  <!-- id_reporte -->
						  <input type="hidden" name="id_reporte" value="<?php echo $id_reporte?>">
						  
      						<table class="table ">
      							<thead class="">
      								<tr>
      									<th>ID</th>
      									<th>Empleado</th>

      									<?php foreach ($servicios as $servicio) : ?>
      										<th><?php echo $servicio->nombre ?></th>
      									<?php endforeach ?>

      									<th>Bono</th>
      									<th>Trb. Extra</th>
      								</tr>
      							</thead>
      							<tbody>
      								<?php foreach ($reporte as $empleado) : ?>
      									<tr>
      										<td><?php echo $empleado->id ?></td>
      										<td><?php echo $empleado->nombre ?></td>

      										<?php foreach ($empleado->servicios as $servicio) : ?>
      											<td>
      												<input required class="form-control solo_entero_positivo" type="number" name="servicios_<?php echo  $servicio->id  ?>[<?php echo  $empleado->id  ?>]" value="<?php echo  $servicio->cantidad_realizada  ?>" min="0" placeholder="<?php echo $servicio->nombre ?>">
      											</td>
      										<?php endforeach ?>
      						
      										<td>

      											<div class="input-group m-0">
      												<div class="input-group-prepend">
      													<span class="input-group-text">$</span>
      												</div>
      												<input required id="bono<?php echo $empleado->id ?>" value="<?php echo $empleado->bono ?>" placeholder="$...." class="form-control numero" type="number" min="0" name="bono[<?php echo $empleado->id ?>]">
      											</div>
												  
											</td>
											<td>
												  <div class="input-group m-0">
													  <div class="input-group-prepend">
														  <span class="input-group-text">$</span>
													  </div>
													  <input required class="form-control numero" type="number" placeholder="$...." value="<?php echo $empleado->tabajo_extra ?>" min="0" name="trabajo_extra[<?php echo $empleado->id ?>]" placeholder="Trabajo extra">
												  </div>
      											<!-- <input > -->
      										</td>



      									</tr>
      								<?php endforeach ?>
      							</tbody>

      						</table>

      						<div class="d-flex justify-content-end mt-3">
      							<button class="btn btn-primary " type="submit">Guardar</button>
      						</div>
      					</form>
      				</div>

      			</div>
      		</div>


      	</div>

      	<!-- Default box -->
      	<!-- /.card -->

      </section>
      <!-- /.content -->

      <!-- <script>
		  window.addEventListener("keyup")
	  </script> -->
