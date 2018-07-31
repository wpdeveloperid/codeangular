<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Code Angular</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/base64.css">
	<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/angular-route.min.js"></script>
<?php if(isset($product)) { ?>
	<base href="/codeangular/product/">
<?php } ?>
</head>

<body>
	<header class="bg-info">
		<div class="container">
			<nav class="navbar navbar-dark navbar-expand">
				<a class="navbar-brand" href="<?php echo base_url(); ?>">CodeAngular</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
				 aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>">Home

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>product/">Products</a>
						</li>

					</ul>
				</div>
			</nav>
		</div>
	</header>