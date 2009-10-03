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
echo br(2);
$format = "%m/%d/%Y %h:%i %a";



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
		$stamp = mysql_to_unix($list->created);
		echo "<p><b>".$U . ":</b> " .
					$list->update . br().
					"<small>".mdate($format,$stamp);
	
		echo "</small></p>";

	}
}

echo heading("Recent Bookmarks", 2);			
if (count($bookmarks)){
	foreach ($bookmarks as $key => $list){
		$stamp = mysql_to_unix($list->created);
		echo "<p>" .
			auto_link($list->url) . br().
			"<small>added ".mdate($format,$stamp);
		echo "</small></p>";

	}
}else{
	echo "Sorry, no bookmarks by this user available!";
}

echo heading("Recent Posts", 2);			
if (count($posts)){
	foreach ($posts as $key => $list){
		$stamp = mysql_to_unix($list->created);
		echo "<p>" .
			anchor("blog/view_post/".$list->id,$list->title) . br().
			"<small>posted ".mdate($format,$stamp);
		echo "</small></p>";

	}
}else{
	echo "Sorry, no blog posts by this user available!";
}

echo heading("Recent Files", 2);			
if (count($files)){
	foreach ($files as $key => $list){
		$stamp = mysql_to_unix($list->created);
		echo "<p>" .
			anchor("files/view_file/".$list->id,$list->title) . br().
			"<small>uploaded ".mdate($format,$stamp);
		echo "</small></p>";

	}
}else{
	echo "Sorry, no files by this user available!";
}

?>