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
		<header>
			<h1>Product</h1>
		</header>
		<main>
			<div ng-controller="listCtrl">
				<div class="my-1">
					<form action="<?php echo base_url(); ?>product/list" method="get" class="form-inline">
						<?php echo form_input(array(
                    'name'      => 'query',
                    'class'=>'form-control mr-1',
                    'placeholder'=>'Search',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'query')); ?>
						<?php echo form_input(array(
                    'name'=>'minprice',
                    'class'=>'form-control mr-1',
                    'placeholder'=>'Min Price',
                    'type'=>'number',
                    'min'=>'0',
                    'max'=>'1000000000000000',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'minPrice')); ?>
						<?php echo form_input(array(
                    'name'=>'maxprice',
                    'class'=>'form-control mr-1',
                    'placeholder'=>'Max Price',
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
                    'class'=>'form-control mr-1'
                ));
                ?>
						<?php //echo form_submit('submit', 'Filter');?>
						<?php echo form_button('reset', 'Reset', array(
                    'ng-click'=>'reset()',
                    'class'=>'btn btn-primary'
                )); ?>
					</form>
				</div>

				<div class="my-1 text-center">
					<div class="btn-group">
						<button ng-repeat="pageIndex in pages" type="button" class="btn btn-outline-dark" ng-click="toPage(this)">{{pageIndex}}</button>
					</div>
				</div>

				<div class="alert alert-danger" ng-show="showAlert" role="alert">
					{{message}}
				</div>
				<div class="row my-1">
					<div ng-repeat="item in items" class="col-md-6 col-lg-3 my-1">
						<div class="card">
							<div>
								<img ng-src="{{item.src}}" width=200 height=200 class="img-fluid card-img-top product__loader">
							</div>
							<div class="card-body">
								<div class="card-title">
									<h5>{{item.name}}</h5>
								</div>
								<div class="card-text">{{item.price|currency:"IDR":0}}</div>
							</div>

						</div>

					</div>
				</div>
			</div>
		</main>

	</div>
	<script>
		var baseUrl = "<?php echo base_url(); ?>";
		var imgFolder = baseUrl + "assets/img/";
		var uploadFolder = baseUrl + "assets/img/upload/";
	</script>
	<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>

</html>