<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html ng-app="productApp">
<head ng-controller="headCtrl">
<title>Product - {{title}}</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/base64.css">
<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
</head>
<body>

<div ng-controller="listCtrl">
<div ng-repeat="item in items">
<div>{{item.name}}</div>
<div>{{item.price}}</div>
<div><img ng-src="<?php echo base_url(); ?>{{'assets/img/upload/'+item.image+'.jpg'}}" width=200 height=200 class="product__loader"></div>
</div>
</div>
<script>
var baseUrl="<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>
</html>
