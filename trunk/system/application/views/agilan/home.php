<?php
/* needs: cleaned up udpates, updates that gets following's updates
*/

echo heading("What is your status?", 2);
if (isset($_SESSION['message'])){
	echo "<b class='message'>".$_SESSION['message']."</b>";
	echo br();
	unset($_SESSION['message']);
}

echo form_open('updates/index');
$input = array('name' => 'status', 'id' => 'status', 'size'=> 40);
echo form_input($input);
echo form_submit('update','update');
echo form_close();



if (count($updates)){
	foreach ($updates as $key => $list){
		$ID = $list->user_id;
		$U = $usernames[$ID];
		echo "<p><b>".$U . ":</b> " .
					$list->update . "<br/>".
					"<small>".$list->created;
	
		if ($ID != $_SESSION['userid']){
			echo nbs() . anchor('users/unfollow/'. $ID, 'unfollow');
		}
		echo "</small></p>";

		if (isset($comments[$list->id]) && count($comments[$list->id]) > 0){
			echo "<ol class='comments'>";
			foreach ($comments[$list->id] as $kk => $ll){
				$CID = $ll->user_id;
				$CU = $usernames[$ll->user_id];
				echo "<li><small><b>".$CU . ":</b> " .
					$ll->comment . "<br/>".
					$ll->created . "</small></li>";
			}
			echo "</ol>";
		}else{
			echo nbs();
		}
		
		echo form_open('comments/index');
		$input = array('name' => 'comment', 'id' => 'comment', 'size'=> 30);
		echo form_input($input);
		echo form_hidden('object','updates');
		echo form_hidden('object_id',$list->id);
		echo br();
		echo form_submit('add comment','add comment');
		echo form_close();


	}
}
?>