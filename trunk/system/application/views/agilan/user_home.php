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
if (count($updates)){
	print_r($updates);
}

?>