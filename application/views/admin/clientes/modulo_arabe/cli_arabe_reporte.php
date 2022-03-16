      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Reporte 20/20/2000</h1>
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
							  <a href="<?php echo site_url("admin_cliente_arabe/vista_creacion_registro") ?>" class="btn btn-primary btn-sm">Facturar</a>

      					</div>
      				</div>


      			</div>
      		</div>


      	</div>

      	<!-- Default box -->
      	<!-- /.card -->

      </section>
      <!-- /.content -->
