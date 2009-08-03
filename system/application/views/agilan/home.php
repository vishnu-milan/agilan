<?php
/* needs: cleaned up udpates, updates that gets following's updates
*/

echo heading("What is your status?", 2);

echo form_open('updates/index');
$input = array('name' => 'status', 'id' => 'status', 'size'=> 40);
echo form_input($input);
echo form_submit('update','update');
echo form_close();


if (count($updates)){
	foreach ($updates as $key => $list){
		$ID = $list['user_id'];
		$U = $usernames[$ID];
		echo "<p><b>".$U . ":</b> " .
					$list['update'] . "<br/>".
					"<small>".$list['created'];
	
		if ($ID != $_SESSION['userid']){
			echo " " . anchor('users/unfollow/'. $ID, 'unfollow');
		}
		echo "</small></p>";
	}
}
?>