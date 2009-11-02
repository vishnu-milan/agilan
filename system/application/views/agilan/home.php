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
$input = array('name' => 'status', 'id' => 'status', 'size'=> 50);
echo form_input($input);
echo form_submit('update','update');
echo form_close();
		
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
		
		comments($comments,$list->id,'updates',$usernames,$format);

	}
}
?>