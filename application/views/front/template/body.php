<!DOCTYPE html>
<html lang="en">

<?php  $this->load->view("front/template/head.php")?>

<body data-spy="scroll" data-target=".fixed-top">

	<!-- Preloader -->
	<div class="spinner-wrapper">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
	<!-- end of preloader -->

	<?php  $this->load->view("front/template/nav.php")?>

	<!-- end of navigation -->


	{body}


	<?php  $this->load->view("front/template/footer.php")?>

</body>

</html>
