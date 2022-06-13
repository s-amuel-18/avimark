<nav class="main-header navbar navbar-expand navbar-dark">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo site_url("admin") ?>" class="nav-link">Inicio</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">


		<?php if ($this->session->userdata("perfil") == "administrador") : ?>
			<li class="nav-item">
				<a class="nav-link" type="button" data-toggle="modal" data-target="#tata-bs-modal" role="button">
					<strong>Bs</strong>
				</a>
			</li>
		<?php endif ?>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
		<li class="nav-item dropdown user user-menu">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
				<i class="far fa-user"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<a href="<?php echo site_url("auth/logout") ?>" class="dropdown-item">
					<i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesion
				</a>

			</div>
		</li>
	</ul>
</nav>
