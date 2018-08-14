<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if($this->router->class!="admin"){ echo "Code Angular";} else{ echo "Administration &ndash; Code Angular"; } ?></title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/base64.css">
	<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/angular-route.min.js"></script>
<?php if($this->router->class=="product") : ?>
	<script src="<?php echo base_url(); ?>assets/js/angular-sanitize.min.js"></script>
	<base href="/codeangular/product/">
<?php elseif($this->router->class=="admin"): ?>
	<script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/tinymce.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/ng-file-upload.min.js"></script>
	<base href="/codeangular/admin/">
<?php endif; ?>
</head>

<?php if($this->router->class!="admin") : ?>
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
							<a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url(); ?>product/">Products</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
<?php else: ?>
<body ng-app="adminApp">
	<header class="bg-dark">
		<nav class="navbar navbar-dark navbar-expand-md py-0">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-between" id="mainNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>">Home Page</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>admin">Administration Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>admin/product">Manage Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>admin/password">Change Password</a>
					</li>
				</ul>
				<span class="text-light">
					Greetings, <?php echo $this->session->userdata('username') ?>. <a href="<?php echo base_url(); ?>logout" class="btn btn-outline-light btn-sm">Logout</a>
			</span>					
			</div>
		</nav>		
	</header>
<?php endif; ?>