<?php
echo form_open('agilan/search');
$input = array('name' => 'searchterm', 'id' => 'searchterm', 'size'=> 15);
echo form_input($input);
echo br();
echo form_submit('search people','search people');
echo form_close();
echo br();
echo anchor("users/index", "see all users");

echo heading("My Tags", 3);
?>

tags go here