<?php

echo heading("My Tags", 2);
echo anchor("tags/all", "see all tags (cloud)");
echo " | ";
echo anchor("tags/all_alpha", "see all tags (alpha)");

echo form_open('tags/update');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20, 'class' => ':required :only_on_submit');
echo form_input($input);
echo form_submit('follow tag','follow tag');
echo form_close();

if (count($results)){
	foreach ($results as $key => $value){
		echo anchor('tags/objects/'.$value , $value) . br();
	
	}

}

?>