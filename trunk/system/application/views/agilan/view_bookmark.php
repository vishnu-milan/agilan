<?php

echo heading($title, 2);
//time format!
$format = "%m/%d/%Y %h:%i %a";


echo auto_link($results->url) . br();
echo $results->description . br();
$stamp = mysql_to_unix($results->created);

echo "<small>" . mdate($format,$stamp). br();

if (isset($bookmark_tags[$results->id]) && count($bookmark_tags[$results->id])){
	echo implode(",",$bookmark_tags[$results->id]);
}
echo "</small>";

echo "<ol class='comments'>";
if (isset($comments[$results->id]) && count($comments[$results->id]) > 0){
	foreach ($comments[$results->id] as $kk => $ll){
		$CID = $ll->user_id;
		$CU = $usernames[$ll->user_id];
		$stamp = mysql_to_unix($ll->created);
		
		echo "<li><small><b>".$CU . ":</b> " .
			$ll->comment . "<br/>".
			mdate($format,$stamp) . "</small></li>";
	}

}else{
	echo nbs();
}

echo form_open('comments/index');
$input = array('name' => 'comment', 'id' => 'comment', 'size'=> 15);
echo form_input($input);
echo form_hidden('object','bookmarks');
echo form_hidden('object_id',$results->id);
echo form_hidden('return_url','bookmarks/index');
echo form_submit('add comment','comment');
echo form_close();

echo "</ol>";



?>