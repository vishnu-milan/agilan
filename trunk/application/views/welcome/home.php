<?php
echo heading("Please login or register!", 2);
echo form_open('welcome/verify');

echo form_label('username', 'username');
$input = array('name' => 'username', 'id' => 'username', 'size'=> 25);
echo form_input($input);

echo form_label('password', 'password');
$input = array('name' => 'password', 'id' => 'password', 'size'=> 16);
echo form_password($input);
echo br(2);
echo form_submit('login','login');

echo form_close();

echo br(2);
echo anchor('welcome/register', 'Not a member yet? Register now!');
?>