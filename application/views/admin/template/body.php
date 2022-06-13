<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php $this->load->view("admin/template/head"); ?>
<!-- head -->

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__wobble" src="<?php echo base_url("assets/front-landing/") ?>images/favicon.svg" alt="AdminLTELogo" height="60" width="60">
		</div>


		<!-- Navbar -->
		<?php $this->load->view("admin/template/nav"); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view("admin/template/aside"); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					{body}
				</div>
				<!--/. container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<?php if ($this->session->userdata("perfil") == "administrador") : ?>
			<!-- modal bolivares -->
			<?php $this->load->view("admin/template/modal-tasa-bolivares"); ?>

			<!-- modal bolivares end -->
		<?php endif ?>

		<!-- scripts -->
		<?php $this->load->view("admin/template/scripts"); ?>
		<!-- scripts -->

		<script>
			$(function() {
				// let form_eliminar_cliente = document.querySelectorAll(".form_eliminar_cliente");

				$.validator.setDefaults({
					submitHandler: function(e) {
						e.submit();
						let buttonSubmit = e.querySelector("button[type='submit']")

						if (buttonSubmit) {
							buttonSubmit.disabled = true
						}

					}
				});

				// VALIDACION
				$('#form_tasa_bolivar').validate({
					rules: {
						tasa: {
							required: true,
						},

					},
					errorElement: 'span',
					errorPlacement: function(error, element) {
						error.addClass('invalid-feedback');
						element.closest('.form-group').append(error);
					},
					highlight: function(element, errorClass, validClass) {
						$(element).addClass('is-invalid');
					},
					unhighlight: function(element, errorClass, validClass) {
						$(element).removeClass('is-invalid');
					}
				});


			});
		</script>

</body>

</html>

<?php

if (isset($_SESSION["message"])) {
	unset($_SESSION["message"]);
}

?>
