<?php

echo heading($title, 2);


//time format!
$format = "%m/%d/%Y %h:%i %a";

echo "Description: ". $results->description . br();
echo "File type: ". $results->file_type .br();
echo "File size: " . $results->file_size . br();
$stamp = mysql_to_unix($results->created);
echo  anchor("files/download/".$results->id, 'download') . br();
echo "<small>uploaded " . mdate($format,$stamp);
echo " by ". $usernames[$results->user_id]. br();
echo "</small>";

show_tags($file_tags,$results->id);
echo br(2);

comments($comments,$results->id,'files',$usernames,$format,'files/index');







?>