<?php
echo form_open('agilan/search');
$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 15);
echo form_input($input);
echo br();
echo form_submit('search people','search people');
echo form_close();
echo br();
echo anchor("users/index", "see all users");
echo br();
echo anchor("agilan/edit_profile",'edit profile');
echo br();
echo anchor("agilan/index",'back home');
echo br(3);
echo anchor("agilan/logout",'logout');
?>