<?php

echo heading($title, 2);


//time format!
$format = "%m/%d/%Y %h:%i %a";

//print_r($results);

$stamp = mysql_to_unix($results->created);

echo "<small>posted " . mdate($format,$stamp);
echo " by ". $usernames[$results->user_id]. br();
echo "</small>";
echo br();

echo auto_typography($results->body);




?>