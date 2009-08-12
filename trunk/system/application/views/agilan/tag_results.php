<?php


echo heading("Tag Results: ". $tagname,2);

//we need to be ready to grab different types of info here
//we know that there are users, bookmarks, files, and such that can be tagged
//for now, I'll keep it like this and then go about adding tagging to another object

echo "<pre>";
print_r($results);
exit();


if (count($results)){
	foreach ($results as $id => $person){
		echo anchor("users/home/".$person['username'], $person['firstname'] . " ". $person['lastname']);
		echo br();
		if ($person['id'] != $_SESSION['userid']){
			echo anchor("users/follow/".$person['id'], "follow status updates");
			echo br();
		}
		echo "Email: ". $person['email'];
		echo br();
		echo "Phone: ". $person['phone'];
		echo br();
		echo "Expertise/Interests: " . $person['tags'];
		echo br(2);
	
	}
}else{
	echo "Sorry, no objects found for this tag!";
}