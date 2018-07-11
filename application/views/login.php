<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open('login/action'); ?>
<?php echo form_input('username'); ?>
<?php echo form_password('password'); ?>
<?php echo form_submit('submit','Login'); ?>
<?php echo form_reset('reset','Reset'); ?>
<?php echo form_close(); ?>
