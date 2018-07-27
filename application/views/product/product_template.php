<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html ng-app="productApp">

<head ng-controller="headCtrl">
	<title>Product - {{title}}</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/base64.css">
	<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
</head>

<body>
	<div class="container">
		<div ng-controller="listCtrl">
			<form action="<?php echo base_url(); ?>product/list" method="get">
				<?php echo form_input(array(
                    'name'      => 'query',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'query')); ?>
				<?php echo form_input(array(
                    'name'=>'minprice',
                    'type'=>'number',
                    'min'=>'0',
                    'max'=>'1000000000000000',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'minPrice')); ?>
				<?php echo form_input(array(
                    'name'=>'maxprice',
                    'type'=>'number',
                    'min'=>'1',
                    'max'=>'1000000000000000',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'maxPrice')); ?>
				<?php $options = array(
                    'newest'    => 'Newest',
                    'lowprice'  => 'Lowest Price',
                    'highprice' => 'Highest Price',
                    'az'        => 'Name Ascending',
                    'za'        => 'Name Descending'
                );
                echo form_dropdown('orderby', $options, 'newest', array(
                    'ng-change'=>'productFilter()',
                    'ng-model'=>'orderBy',
                    
                ));
                ?>
				<?php //echo form_submit('submit', 'Filter');?>
				<?php echo form_button('reset', 'Reset', array(
                    'ng-click'=>'reset()'
                )); ?>
			</form>
			<div class="btn-group">
				<button ng-repeat="pageIndex in pages" type="button" class="btn btn-secondary" ng-click="toPage(this)">{{pageIndex}}</button>
			</div>
			{{message}}
			<div class="row">
				<div ng-repeat="item in items" class="col-md-6 col-lg-3">
					<div>{{item.name}}</div>
					<div>{{item.price}}</div>
					<div>
						<img ng-src="{{item.src}}" width=200 height=200 class="product__loader">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var baseUrl = "<?php echo base_url(); ?>";
		var imgFolder = baseUrl + "assets/img/";
		var uploadFolder = baseUrl + "assets/img/upload/";
	</script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>

</html>