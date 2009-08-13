<?php

echo heading("Tag Directory", 2);

echo form_open('tags/update');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20);
echo form_input($input);
echo form_submit('add tag','add tag');
echo form_close();

if (count($results)){
	foreach ($results as $key => $value){
		echo anchor('tags/objects/'.$value , $value) . br();
	
	}

}

?>