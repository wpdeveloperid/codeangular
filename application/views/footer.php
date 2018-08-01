<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
	<script>
		var baseUrl = "<?php echo base_url(); ?>";
		var imgFolder = baseUrl + "assets/img/";
		var uploadFolder = baseUrl + "assets/img/upload/";
	</script>    
	
	<?php if($this->router->class!="admin"): ?>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
	<?php else: ?>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<?php endif ?>
</body>

</html>