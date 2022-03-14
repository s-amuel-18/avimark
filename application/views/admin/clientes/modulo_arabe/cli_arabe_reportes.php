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
      								<a class="dropdown-item dropdown-left" href="<?php echo site_url("admin_cliente_arabe/configuracion") ?>">Configuracion</a>
      							</div>
      						</div>
      					</div>
      				</div>


      			</div>
      		</div>


      	</div>

      	<!-- Default box -->
      	<!-- /.card -->

      </section>
      <!-- /.content -->
