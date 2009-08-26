<?php
/*
needs: form validation, upload of photo
*/


echo heading("Add File Details", 2);
echo form_open('files/insert');


echo form_label('Location', 'location');
echo "<b>". $location."</b>";
echo form_hidden('location',$location);

echo form_label('Title', 'title');
$input = array('name' => 'title', 'id' => 'title', 'size'=> 40);
echo form_input($input);


echo form_label('Description', 'description');
$input = array('name' => 'description', 'id' => 'description', 'rows'=> 10, 'cols' => 35);
echo form_textarea($input);

echo form_label('Tags', 'tags');
$input = array('name' => 'tags', 'id' => 'tags', 'size'=> 40);
echo form_input($input);


echo br(2);
echo form_submit('add','add');

echo form_close();

?>