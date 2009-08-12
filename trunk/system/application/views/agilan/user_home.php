<?php

echo heading("Profile for ". $user['firstname'] . " " . $user['lastname'], 2);

echo heading('Short Biography', 4);
echo $user['bio'];

echo heading('Expertise/Interests', 4);
echo $user['tags'];

echo heading('Email address', 4);
echo $user['email'];

echo heading('Phone number', 4);
echo $user['phone'];

echo heading('Username', 4);
echo $user['username'];




echo heading("Recent Updates", 2);
if ($user['id'] != $_SESSION['userid']){
	if (in_array($user['id'],$following)){
		echo anchor("users/unfollow/".$user['id'], "stop following");
		echo br();			
	}else{
		echo anchor("users/follow/".$user['id'], "follow status updates");
		echo br();
	}
}
			
if (count($updates)){
	foreach ($updates as $key => $list){
		$U = $user['username'];
		echo "<p><b>".$U . ":</b> " .
					$list->update . "<br/>".
					"<small>".$list->created;
	
		echo "</small></p>";

	}
}
?>