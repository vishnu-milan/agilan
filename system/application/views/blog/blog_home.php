<?php

echo heading("Blog Posts", 2);

echo anchor("blog/update", "add a blog post");
echo br(2);

//time format!
$format = "%m/%d/%Y %h:%i %a";


if (count($results)){
	foreach ($results as $key => $list){
		echo heading(anchor("blog/view_post/".$list->id,$list->title),2);
		$stamp = mysql_to_unix($list->created);
		
		echo "<small>posted " . mdate($format,$stamp);
		echo " by ". $usernames[$list->user_id]. br();
		echo "</small>";
		echo br(2);


	}

}

?>