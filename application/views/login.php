<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html ng-app="loginApp">
<head>
<title>Login - Code Angular</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
</head>
<body> 

<div ng-controller="loginCtrl" class="bg-info d-flex align-items-center" style="height:100vh">
<div class="container">
<div class="row">
<div class="col-lg-4 offset-lg-4">
<h1 class="text-center text-light font-weight-light">Login</h1>
<?php echo form_open('login/action'); ?>
<div class="alert alert-danger" ng-hide="hideAlert">{{message}}</div>
<?php echo form_input(array(
    'name'=>'username',
    'class'=>'form-control my-2',
    'placeholder'=>'Username',
    'ng-model'=>'username')); ?>
<?php echo form_password(array(
    'name'=>'password',
    'class'=>'form-control my-2',
    'placeholder'=>'Password',
    'ng-model'=>'password')); ?>
<?php echo form_button('submit','Login',array(    
    'class'=>'btn btn-outline-light btn-block',    
    'ng-click'=>'login()'
)); ?>
<?php /* echo form_submit(array(
    'name'=>'submit',
    'class'=>'btn btn-outline-light btn-block',
    'value'=>'Submit'
)); */ ?>
<?php echo form_reset(array(
    'name'=>'reset',
    'class'=>'btn btn-outline-light btn-block',
    'value'=>'Reset',
    'ng-click'=>'reset()'
)); ?>
<?php echo form_close(); ?>
<a href="<?php echo base_url(); ?>" class="text-light">Back to home</a></div></div>
</div>
</div>
<script>
		var baseUrl = "<?php echo base_url(); ?>";		
</script>    
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>

</html>