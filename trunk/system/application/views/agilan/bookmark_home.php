<?php

echo heading("My Bookmarks", 2);

echo form_open('bookmarks/update');
$input = array('name' => 'url', 'id' => 'url', 'size'=> 20);
echo form_input($input);
echo br();
echo form_submit('add bookmark','add bookmark');
echo form_close();
echo br();

if (count($results)){
	foreach ($results as $key => $list){
		echo auto_link($list->url) . br();
		echo $list->description . br();
		echo "<small>" . $list->created. br();
	
		if (isset($bookmark_tags[$list->id]) && count($bookmark_tags[$list->id])){
			echo implode(",",$bookmark_tags[$list->id]);
		}
		echo "</small>";
		echo br(2);


	}

}

?>