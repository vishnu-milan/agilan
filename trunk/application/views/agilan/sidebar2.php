<script type="text/javascript">
	//initiate validator on load
	$(function() {
		
		// validate contact form on keyup and submit
		$("#searchForm").validate({
			//set the rules for the fild names
			rules: {
				searchterm: {
					required: true,
					minlength: 1
				},
	
				
			},
			//set messages to appear inline
			messages: {
				searchterm: "Please enter a searchterm",
			}
		});
	});
</script>

<?php echo heading('Welcome ' .$user['firstname'],4);?>
	<?php
	$attributes = array('id' => 'searchForm');

	echo form_open('agilan/search',$attributes);
	$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 15);
	echo form_input($input);
	echo form_submit('search','search');
	echo form_close();
	?>	
<ul class="localnav">
<li><?php echo anchor("users/home/".$_SESSION['logged_in_user']['username'], 'view profile');?></li>
<li><?php echo anchor("agilan/edit_profile",'edit profile');?></li>
<li><?php echo anchor("agilan/logout",'logout');?></li>
</ul>