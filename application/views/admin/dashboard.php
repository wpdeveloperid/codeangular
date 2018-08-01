    <div class="container-fluid">
        <h1>Welcome, <?php echo $this->session->userdata('username') ?></h1>        
    </div>
    <ng-view></ng-view>
</div> <!-- closing adminApp -->

