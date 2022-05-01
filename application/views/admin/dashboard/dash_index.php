      <!-- Content Header (Page header) -->
      <section class="content-header">
      	<div class="container-fluid">
      		<div class="row mb-2">
      			<div class="col-sm-6">
      				<h1>Inicio</h1>
      			</div>
      		</div>
      	</div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

      	<div class="row">
      		<div class="col-md-3">
      			<div class="small-box bg-success">
      				<div class="inner">
      					<h3><?php echo $users?></h3>
      					<h5>Usuarios Registrados</h5>
      				</div>
      				<div class="icon"><i class="fas fa-users"></i></div> <a href="contact-email/" class="small-box-footer">

      					Ver Usuarios

      					<i class="fas fa-lg fa-arrow-circle-right"></i></a>
      				<div class="overlay d-none"><i class="fas fa-2x fa-spin fa-sync-alt text-gray"></i></div>
      			</div>
      		</div>
      		<div class="col-md-3">
      			<div class="small-box bg-info">
      				<div class="inner">
      					<h3><?php echo $visitas->num_rows()?></h3>
      					<h5>Vistas Semanal</h5>
      				</div>
      				<div class="icon"><i class="fas fa-user"></i></div> <a  class="small-box-footer">

								Vistas
      					<!-- <i class="fas fa-lg fa-arrow-circle-right"></i></a> -->
      				<div class="overlay d-none"><i class="fas fa-2x fa-spin fa-sync-alt text-gray"></i></div>
      			</div>
      		</div>

      	</div>

      </section>
      <!-- /.content -->
