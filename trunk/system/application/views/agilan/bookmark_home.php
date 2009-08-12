<?php

echo heading("My Bookmarks", 2);

if (count($results)){
	foreach ($results as $key => $list){
		echo auto_link($list->url) . br();
		echo $list->description . br();
		echo "<small>" . $list->created ."</small>";
		echo br(2);
	
	}

}
?>