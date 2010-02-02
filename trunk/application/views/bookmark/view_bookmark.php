<?php

echo heading($title, 2);
//time format!
$format = "%m/%d/%Y %h:%i %a";


echo auto_link($results->url,'url',TRUE) . br();
echo $results->description . br();
$stamp = mysql_to_unix($results->created);

echo "<small>posted " . mdate($format,$stamp);
echo " by ". $usernames[$results->user_id]. br();
echo "</small>";

show_tags($bookmark_tags,$results->id);


echo br(2);


comments($comments,$results->id,'bookmarks',$usernames,$format,'bookmarks/index');




?>