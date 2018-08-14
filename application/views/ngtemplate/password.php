<div class="container-fluid">
    <h1>Hello, <?php echo $this->session->userdata('username') ?></h1>
    <p>Want to change your password?</p>
    <div class="alert alert-{{alertType}}" ng-hide="hideAlert">{{message}}</div>
<?php echo form_password(array(
    'name'=>'oldpassword',
    'class'=>'form-control my-2',
    'placeholder'=>'Type old password',
    'ng-model'=>'oldpassword')); ?>
    <?php echo form_password(array(
    'name'=>'newpassword',
    'class'=>'form-control my-2',
    'placeholder'=>'Type new password',
    'ng-model'=>'newpassword')); ?>
    <?php echo form_password(array(
    'name'=>'confirmpassword',
    'class'=>'form-control my-2',
    'placeholder'=>'Confirm new password',
    'ng-model'=>'confirmpassword')); ?>
<?php echo form_button('submit','Change password',array(    
    'class'=>'btn btn-primary btn-block',    
    'ng-click'=>'change()'
)); ?>
<?php echo form_reset(array(
    'name'=>'reset',
    'class'=>'btn btn-primary btn-block',
    'value'=>'Reset',
    'ng-click'=>'reset()'
)); ?>
</div>