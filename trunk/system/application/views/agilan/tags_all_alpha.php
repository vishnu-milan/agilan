<?php

echo heading("Tag Directory (Alpha)", 2);
echo anchor("tags/index", "my tags");
echo " | ";
echo anchor("tags/all", "see all tags (cloud)");

echo form_open('tags/update');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20);
echo form_input($input);
echo form_submit('follow tag','follow tag');
echo form_close();



if (count($results)){
	foreach ($results as $key => $value){
		echo anchor('tags/objects/'.$value , $value) . br();
	
	}

}

?>