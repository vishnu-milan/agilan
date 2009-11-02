<?php
/*
needs: form validation, upload of photo
*/


echo heading("Update your profile!", 2);
echo form_open_multipart('agilan/update_profile');


$properties = array(
			'src' => 'users/get_photo/'. $user['id'],
			'width' => '120',
			'height' => '90'
);
echo img($properties,true);
echo br();
echo form_label("Change your profile image", 'photo');
echo form_hidden("MAX_FILE_SIZE",'80000');
echo "<input type='file' name='photo' id='photo' size='20' />";

echo form_label('Your username', 'username');
echo "<b>".$user['username'] ."</b>";

echo form_label('Your first name', 'firstname');
$input = array('name' => 'firstname', 'id' => 'firstname', 'size'=> 40, 'value' => $user['firstname'],'class' => ':required :only_on_submit');
echo form_input($input);

echo form_label('Your last name', 'lastname');
$input = array('name' => 'lastname', 'id' => 'lastname', 'size'=> 40, 'value' => $user['lastname'],'class' => ':required :only_on_submit');
echo form_input($input);

echo form_label('Your email address', 'email');
$input = array('name' => 'email', 'id' => 'email', 'size'=> 40, 'value' => $user['email'],'class' => ':email :required :only_on_submit');
echo form_input($input);

echo form_label('Your phone number', 'phone');
$input = array('name' => 'phone', 'id' => 'phone', 'size'=> 20, 'value' => $user['phone']);
echo form_input($input);


echo form_label('Choose a new password', 'password');
$input = array('name' => 'password', 'id' => 'password', 'size'=> 20,'class' => ':required');
echo form_input($input);


echo form_label('Confirm password', 'confirm');
$input = array('name' => 'confirm', 'id' => 'confirm', 'size'=> 20,'class' => ':same_as;password');
echo form_input($input);


echo form_label('A short bio of yourself', 'bio');
$input = array('name' => 'bio', 'id' => 'bio', 'rows'=> 10, 'cols' => 35,'value' => $user['bio']);
echo form_textarea($input);


echo form_label('Your expertise (separate with commas)', 'tags');
$input = array('name' => 'tags', 'id' => 'tags', 'size'=> 40,'value' => $user['tags']);
echo form_input($input);

echo br(2);
echo form_submit('update','update');

echo form_close();

?>