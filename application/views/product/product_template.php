<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html ng-app="productApp">
<head ng-controller="headCtrl">
<title>{{title+' - '+description}}</title>
<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
</head>

<body>

<div ng-controller="listCtrl">
<div ng-repeat="item in items">
<div>{{item.name}}</div>
<div>{{item.price}}</div>
<div><img src="{{src}}"></img></div>
</div>
</div>
<script>
var baseUrl="<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>
</html>
