<?php
/*
needs: form validation, upload of photo
*/


echo heading("Add Bookmark", 2);
echo form_open('bookmarks/insert');

echo form_label('URL', 'url');
$input = array('name' => 'url', 'id' => 'url', 'size'=> 40, 'value' => $url);
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