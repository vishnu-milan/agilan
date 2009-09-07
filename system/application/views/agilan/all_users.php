<?php


echo heading("All Users",2);

if (count($results)){
	foreach ($results as $id => $person){
		echo anchor("users/home/".$person->username, $person->firstname . " ". $person->lastname);
		echo br();

		$properties = array(
					'src' => 'users/get_photo/'. $person->id,
					'width' => '120',
					'height' => '90'
		);
		echo img($properties,true);

		$properties = array();
		echo br();
		if ($person->id != $_SESSION['userid']){
			if (in_array($person->id,$following)){
				echo anchor("users/unfollow/".$person->id, "stop following");
				echo br();			
			}else{
				echo anchor("users/follow/".$person->id, "follow status updates");
				echo br();
			}
		}
		
		echo "Email: ". $person->email;
		echo br();
		echo "Phone: ". $person->phone;
		echo br();
		echo "Expertise/Interests: " ;
		
		if (isset($user_tags[$person->id]) && count($user_tags[$person->id])){
			echo implode(",", $user_tags[$person->id]);
		}
		echo br(2);
	
	}
}else{
	echo "Sorry, no search results matched that query!";
}