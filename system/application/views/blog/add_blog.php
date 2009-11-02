<?php
/*
needs: form validation
*/


echo heading("Add Blog Post", 2);
echo form_open('blog/insert');

echo form_label('Title', 'title');
$input = array('name' => 'title', 'id' => 'title', 'size'=> 40, 'class' => ':required :only_on_submit');
echo form_input($input);


echo form_label('Body', 'body');
$input = array('name' => 'body', 'id' => 'body', 'rows'=> 10, 'cols' => 35);
echo form_textarea($input);

echo form_label('Tags', 'tags');
$input = array('name' => 'tags', 'id' => 'tags', 'size'=> 40, 'class' => ':required :only_on_submit');
echo form_input($input);


echo br(2);
echo form_submit('add','add');

echo form_close();

?>