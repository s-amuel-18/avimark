	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

		<!-- Text Logo - Use this if you don't have a graphic logo -->
		<!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Corso</a> -->

		<!-- Image Logo -->
		<a class="navbar-brand" href="<?php echo site_url()?>"><img width="150" src="<?php echo base_url("assets/front-landing/")?>images/logo-avi.svg" alt="alternative"></a>

		<!-- Mobile Menu Toggle Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-awesome fas fa-bars"></span>
			<span class="navbar-toggler-awesome fas fa-times"></span>
		</button>
		<!-- end of mobile menu toggle button -->

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link page-scroll" href="#register">REGISTER <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link page-scroll" href="#description">DETAILS</a>
				</li>

				<!-- Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle page-scroll" href="#date" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">DATE</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="article-details.html"><span class="item-text">ARTICLE DETAILS</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMS CONDITIONS</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACY POLICY</span></a>
					</div>
				</li>
				<!-- end of dropdown menu -->

				<li class="nav-item">
					<a class="nav-link page-scroll" href="#contact">CONTACT</a>
				</li>
			</ul>
			<span class="nav-item social-icons">
				<span class="fa-stack">
					<a href="#your-link">
						<i class="fas fa-circle fa-stack-2x"></i>
						<i class="fab fa-facebook-f fa-stack-1x"></i>
					</a>
				</span>
				<span class="fa-stack">
					<a href="#your-link">
						<i class="fas fa-circle fa-stack-2x"></i>
						<i class="fab fa-twitter fa-stack-1x"></i>
					</a>
				</span>
			</span>
		</div>
	</nav>
	<!-- end of navbar -->
