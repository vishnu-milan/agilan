<?php

echo heading("Bookmarks Directory", 2);

echo form_open('bookmarks/update');
$input = array('name' => 'url', 'id' => 'url', 'size'=> 20);
echo form_input($input);
echo form_submit('add bookmark','add');
echo form_close();
echo br();

//time format!
$format = "%m/%d/%Y %h:%i %a";


if (count($results)){
	foreach ($results as $key => $list){
		echo auto_link($list->url,'url',TRUE) . br();
		$stamp = mysql_to_unix($list->created);
		echo  anchor("bookmarks/view_bookmark/".$list->id, 'see details') . br();

		echo "<small>posted " . mdate($format,$stamp);
		echo " by ". $usernames[$list->user_id]. br();

		echo "</small>";



		echo br(2);


	}

}

?>