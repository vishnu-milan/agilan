<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title><?php echo $title;?></title>
<?php
echo link_tag('assets/css/960.css');
echo link_tag('assets/css/reset.css');
echo link_tag('assets/css/text.css');
echo link_tag('assets/css/local.css');
?>
</head>
<body>
<!-- header -->
<div class="container_12">
	<div class="grid_2" id="sitelogo">
	<?php 
	$props = array('src' => 'assets/img/agilan.jpg');
	echo anchor('agilan/index',img($props));?>
	</div>
	
	<div class='grid_9'>
	<?php $this->load->view($_SESSION['globalnav']);?>
	</div>


	
</div>


<!-- main body -->
<div class="container_12">
	<div class="grid_2">
	<?php $this->load->view($_SESSION['sidebar1']);?>
	</div>
	<div class="grid_6">
	<?php $this->load->view($main_view);?>
	</div>

	<div class="grid_3">
	<?php $this->load->view($_SESSION['sidebar2']);?>
	</div>

</div>




</body>
</html>

