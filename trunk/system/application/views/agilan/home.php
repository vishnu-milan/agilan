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
$input = array('name' => 'status', 'id' => 'status', 'size'=> 50, 'class' => ':required :only_on_submit');
echo form_input($input);
echo form_submit('update','update');
echo form_close();
		
		
//time format!
$format = "%m/%d/%Y %h:%i %a";



if (count($updates)){
	foreach ($updates as $key => $list){
		$ID = $list->user_id;
		$U = $usernames[$ID];
		echo "<p>";
		$properties = array(
			'src' => 'users/get_photo/'. $ID,
			'width' => '45',
			'height' => '30',
			'align' => 'left',
			'hspace' => '5'
		);
		echo img($properties,true);

		$properties = array();
		$stamp = mysql_to_unix($list->created);
		
		echo "<b>".$U . ":</b> " .
					$list->update . "<br/>".
					"<small>".mdate($format,$stamp);
	
		if ($ID != $_SESSION['userid']){
			echo nbs() . anchor('users/unfollow/'. $ID, 'unfollow');
		}
		echo "</small></p>";

		echo "<ol class='comments'>";
		if (isset($comments[$list->id]) && count($comments[$list->id]) > 0){
			foreach ($comments[$list->id] as $kk => $ll){
				$CID = $ll->user_id;
				$CU = $usernames[$ll->user_id];
				
				$stamp = mysql_to_unix($ll->created);
				
				echo "<li><b>".$CU . ":</b> <small>" .
					$ll->comment . "<br/>".
					mdate($format,$stamp) . "</small></li>";
			}
		}else{
			echo nbs();
		}
		
		echo "<li class='last'>";
		echo form_open('comments/index');
		$input = array('name' => 'comment', 'id' => 'comment', 'size'=> 35, 'class' => ':required :only_on_submit');
		echo form_input($input);
		echo form_hidden('object','updates');
		echo form_hidden('object_id',$list->id);
		echo form_submit('add comment','comment');
		echo form_close();
		echo "</li>";
		echo "</ol>";

	}
}
?>