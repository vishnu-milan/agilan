<?php

echo heading("My Tags", 2);

echo form_open('tags/update');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20);
echo form_input($input);
echo br();
echo form_submit('add tag','add tag');
echo form_close();
echo br();

if (count($results)){
	foreach ($results as $key => $value){
		echo anchor('tags/objects/'.$value , $value) . br();
	
	}

}

?>