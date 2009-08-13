<?php
echo heading("Search People",4);
echo form_open('agilan/search');
$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 15);
echo form_input($input);
echo form_submit('go','go');
echo form_close();

?>

<ul id="rightnav">
<li><?php echo anchor("users/index", "see all users");?></li>
<li><?php echo anchor("agilan/edit_profile",'edit profile');?></li>
<li><?php echo anchor("agilan/logout",'logout');?></li>
</ul>