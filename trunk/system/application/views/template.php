<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title><?php echo $title;?></title>
<?php
echo link_tag('css/960.css');
echo link_tag('css/reset.css');
echo link_tag('css/text.css');
echo link_tag('css/local.css');
?>
</head>
<body>
<!-- header -->
<div class="container_12">
	<div class="grid_2">
	<?php echo anchor("welcome/index","agilan");?>
	</div>
	
	<div class='grid_7'>
	<?php $this->load->view($_SESSION['globalnav']);?>
	</div>

	<div class='grid_2'>
	<?php
	echo form_open('agilan/search');
	$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 10);
	echo form_input($input);
	echo form_submit('search','search');
	echo form_close();
	?>	
	</div>
	
</div>


<!-- main body -->
<div class="container_12">
	<div class="grid_3">
	<?php $this->load->view($_SESSION['sidebar1']);?>
	</div>
	<div class="grid_6">
	<?php $this->load->view($main_view);?>
	</div>

	<div class="grid_2">
	<?php $this->load->view($_SESSION['sidebar2']);?>
	</div>

</div>

<!-- footer -->
<div class="container_12">
	<div class="grid_4">
	<p>Thanks for using agilan....</p>
	</div>
</div>


</body>
</html>

