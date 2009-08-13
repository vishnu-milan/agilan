<?php

echo heading("My Bookmarks", 2);

echo form_open('bookmarks/update');
$input = array('name' => 'url', 'id' => 'url', 'size'=> 20);
echo form_input($input);
echo form_submit('add bookmark','add');
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

		echo "<ol class='comments'>";
		if (isset($comments[$list->id]) && count($comments[$list->id]) > 0){
			foreach ($comments[$list->id] as $kk => $ll){
				$CID = $ll->user_id;
				$CU = $usernames[$ll->user_id];
				echo "<li><small><b>".$CU . ":</b> " .
					$ll->comment . "<br/>".
					$ll->created . "</small></li>";
			}
		
		}else{
			echo nbs();
		}
		
		echo form_open('comments/index');
		$input = array('name' => 'comment', 'id' => 'comment', 'size'=> 15);
		echo form_input($input);
		echo form_hidden('object','bookmarks');
		echo form_hidden('object_id',$list->id);
		echo form_hidden('return_url','bookmarks/index');
		echo form_submit('add comment','comment');
		echo form_close();

		echo "</ol>";



		echo br(2);


	}

}

?>