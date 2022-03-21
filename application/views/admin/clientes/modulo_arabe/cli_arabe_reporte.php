      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Reporte</h1>
      			</div>
      			<div class="col-sm-6">
      				<ol class="breadcrumb float-sm-right">
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
      					<li class="breadcrumb-item"><a href="<?php echo site_url("admin_cliente_arabe") ?>">Registro Arabe</a></li>
      					<li class="breadcrumb-item active">Reporte 20/20/2000</li>
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
      					<h3 class="card-title">Reporte</h3>

      					<div class="card-tools">
      						<a href="<?php echo site_url("admin_cliente_arabe/facturar_reportes?" . $url_parametros) ?>" class="btn btn-primary btn-sm">Facturar</a>
      					</div>
      				</div>

      				<div class="card-body">
      					<table class="table text-center table-striped table-valign-middle">
      						<thead class="">
      							<tr>

      								<th>#</th>
      								<th>ID</th>
      								<th>Empleado</th>

      								<?php foreach ($servicios as $servicio) : ?>
      									<th><?php echo $servicio->nombre ?></th>
      								<?php endforeach ?>

      								<th>Bono</th>
      								<th>Trb. Extra</th>
      								<th>Sub Total</th>

      							</tr>
      						</thead>
      						<tbody>

      							<?php foreach ($reporte as $i =>  $empleado) : ?>
      								<tr>
      									<td style="width: 20px;">

      										<?php if ($i === 0) : ?>
      											<i class="text-warning fas fa-crown fa-fw" style="color: var(--fa-navy);"></i>
      										<?php else : ?>
      											<?php echo $i + 1 ?>
      										<?php endif ?>
      									</td>


      									<td style="width: 20px;"><?php echo $empleado->id ?></td>
      									<td><?php echo $empleado->nombre ?></td>
      									<?php foreach ($empleado->servicios as $servicio) : ?>
      										<td>
      											<div class="row no-guetter">
      												<!-- Header -->
      												<!-- <div class="col-6">
      													<strong>Cantidad</strong>
      												</div>
      												<div class="col-6">
      													<strong>Pago</strong>
      												</div> -->

      												<!-- Bpdy -->
      												<div class="col-6">
      													<?php echo $servicio->cantidad_realizada ?>
      												</div>
      												<div class="col-6">
      													$<?php echo number_format($servicio->pago_por_servicio, 2) ?>
      												</div>

      											</div>
      										</td>
      									<?php endforeach ?>
      									<td style="max-width: 180px;">$<?php echo number_format($empleado->bono, 2) ?></td>
      									<td style="max-width: 180px;">$<?php echo number_format($empleado->tabajo_extra, 2) ?></td>
      									<td style="max-width: 180px;">$<?php echo number_format($empleado->total_pago, 2) ?></td>

      								</tr>
      							<?php endforeach ?>
      						</tbody>
      						<tfoot>
      							<tr>
      								<th>#</th>
      								<th>-</th>
      								<th>--------</th>

      								<?php foreach ($servicios as $servicio) : ?>
      									<th>--------</th>
      								<?php endforeach ?>

      								<th>--------</th>
      								<th>Total a pagar</th>
      								<th>$<?php echo number_format( $precio_total_servicios, 2 ) ?></th>
      							</tr>
      						</tfoot>
      					</table>
      				</div>

      			</div>
      		</div>


      	</div>



      	<!-- Default box -->
      	<!-- /.card -->

      </section>
      <!-- /.content -->
