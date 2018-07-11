<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html ng-app="productApp">
<head ng-controller="headCtrl">
<title>Login - {{title}}</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/base64.css">
<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
</head>
<body>
<?php echo form_open('login/action'); ?>
<?php echo form_input('username'); ?>
<?php echo form_password('password'); ?>
<?php echo form_submit('submit','Login'); ?>
<?php echo form_reset('reset','Reset'); ?>
<?php echo form_close(); ?>
<script>
var baseUrl="<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>
</html> 
