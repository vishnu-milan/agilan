<?php
echo form_open('agilan/search');
$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 15);
echo form_input($input);
echo br();
echo form_submit('search people','search people');
echo form_close();
echo br();
?>

<ul id="rightnav">
<li><?php echo anchor("users/index", "see all users");?></li>
<li><?php echo anchor("agilan/edit_profile",'edit profile');?></li>
<li><?php echo anchor("agilan/logout",'logout');?></li>
</ul>