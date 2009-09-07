<?php


echo heading("Tag Results: ". $tagname,2);
echo anchor("tags/all", "see all tags");
echo br();

//time format!
$format = "%m/%d/%Y %h:%i %a";


if (count($results)){
	foreach ($results as $object => $info){
		echo heading($object,3);
		foreach ($info as $id => $list){
			switch($object){
				case "bookmarks":
					echo "<blockquote>";
					echo auto_link($list->url) . br();
					echo $list->description . br();
					$stamp = mysql_to_unix($list->created);
					echo "<small>" . mdate($format,$stamp). br() . "</small>";
					echo br(2);
					echo "</blockquote>";

				break;
				
				case "files":
					echo "<blockquote>";
					echo $list->title . br();
					echo $list->description . br();
					$stamp = mysql_to_unix($list->created);
					echo  anchor("files/download/".$list->id, $list->title) . br();
					echo "<small>" . mdate($format,$stamp). br() . "</small>";
					echo br(2);
					echo "</blockquote>";

				break;
				
				case "users":
					echo "<blockquote>";
					echo anchor("users/home/".$list->username, $list->firstname . " ". $list->lastname);
					echo br();
					echo "Email: ". $list->email;
					echo br();
					echo "Phone: ". $list->phone;
					echo br(2);
					echo "</blockquote>";
				break;
			}	
	
		}
	}

}else{
	echo "Sorry, no objects found for this tag!";
}