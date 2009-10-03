<?php echo heading('Welcome ' .$user['firstname'],4);?>
	<?php
	echo form_open('agilan/search');
	$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 15);
	echo form_input($input);
	echo form_submit('search','search');
	echo form_close();
	?>	
<ul class="localnav">
<li><?php echo anchor("agilan/edit_profile",'edit profile');?></li>
<li><?php echo anchor("agilan/logout",'logout');?></li>
</ul>