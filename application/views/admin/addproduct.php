<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open_multipart('product/add'); ?>
<?php echo form_input('name'); ?>
<?php echo form_input(array('name'=>'price','type'=>'number')); ?>
<?php echo form_upload(array('name'=>'image','accept'=>'.jpeg')); ?>
<?php echo form_submit('submit','Add'); ?>
<?php echo form_reset('reset','Reset'); ?>
<?php echo form_close(); ?>
