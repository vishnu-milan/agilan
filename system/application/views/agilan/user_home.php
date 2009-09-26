<?php

echo heading("Profile for ". $user['firstname'] . " " . $user['lastname'], 2);
$properties = array(
			'src' => 'users/get_photo/'. $user['id'],
			'width' => '120',
			'height' => '90'
);
echo img($properties,true);
echo br();
$properties = array();

echo form_label('Short Biography', 'bio');
echo $user['bio'];

echo form_label('Expertise/Interests', 'tags');
echo $user['tags'];

echo form_label('Email address', 'email');
echo mailto($user['email'],$user['email']);

echo form_label('Phone number', 'phone');
echo $user['phone'];

echo form_label('Username', 'username');
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