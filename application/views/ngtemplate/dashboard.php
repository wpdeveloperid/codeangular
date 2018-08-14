<div class="container-fluid">
    <h1>Welcome, <?php echo $this->session->userdata('username') ?></h1>
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="alert alert-info">
                <h2 class="display-4"><a href="<?php echo base_url(); ?>admin/product">Manage Product</a></h2>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="alert alert-danger">
                <h2 class="display-4"><a href="<?php echo base_url(); ?>admin/product/add">Add Product</a></h2>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="alert alert-warning">
                <h2 class="display-4"><a href="<?php echo base_url(); ?>admin/password">Change Password</a></h2>
            </div>
        </div>
    </div>
</div>