<?php
/*
needs: form validation, upload of photo
*/


echo heading("Please register!", 2);
echo form_open('welcome/create');

echo form_label('Your first name', 'firstname');
$input = array('name' => 'firstname', 'id' => 'firstname', 'size'=> 40);
echo form_input($input);

echo form_label('Your last name', 'lastname');
$input = array('name' => 'lastname', 'id' => 'lastname', 'size'=> 40);
echo form_input($input);

echo form_label('Your email address', 'email');
$input = array('name' => 'email', 'id' => 'email', 'size'=> 40);
echo form_input($input);

echo form_label('Your phone number', 'phone');
$input = array('name' => 'phone', 'id' => 'phone', 'size'=> 20);
echo form_input($input);


echo form_label('Choose a username', 'username');
$input = array('name' => 'username', 'id' => 'username', 'size'=> 40);
echo form_input($input);

echo br();
echo "<small>Note: a random password will be generated for you!</small>";
echo br();

echo form_label('A short bio of yourself', 'bio');
$input = array('name' => 'bio', 'id' => 'bio', 'rows'=> 10, 'cols' => 35);
echo form_textarea($input);


echo form_label('Your expertise (separate with commas)', 'tags');
$input = array('name' => 'tags', 'id' => 'tags', 'size'=> 40);
echo form_input($input);

echo br(2);
echo form_submit('register','register');

echo form_close();

echo br(2);
echo anchor('welcome/index', 'Already a member? Login now!');
?>