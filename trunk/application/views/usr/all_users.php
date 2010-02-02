<?php
echo heading("All Users",2);
$TABLE = array();

if (count($results)){
	foreach ($results as $id => $person){
		$string = anchor("users/home/".$person->username, $person->firstname . " ". $person->lastname);
		$string .= br();

		$properties = array(
					'src' => 'users/get_photo/'. $person->id,
					'width' => '120',
					'height' => '90'
		);
		$string .= img($properties,true);

		$properties = array();
		$string .= br();
		if ($person->id != $_SESSION['userid']){
			if (in_array($person->id,$following)){
				$string .= anchor("users/unfollow/".$person->id, "stop following");
				$string .= br();			
			}else{
				$string .= anchor("users/follow/".$person->id, "follow status updates");
				$string .= br();
			}
		}
		
		$string .= "Email: ". mailto($person->email,$person->email);
		$string .= br();
		$string .= "Phone: ". $person->phone;
		$string .= br();
		$string .= "Expertise/Interests: " ;
		
		if (isset($user_tags[$person->id]) && count($user_tags[$person->id])){
			$string .= implode(",", $user_tags[$person->id]);
		}
		//echo br(2);
		
		$TABLE[] = $string;
	}

	
	$tmpl = array (
		'table_open'  => "<table class='grid'>",
		'row_start'   => "<tr valign='top'>",
	);
	$this->table->set_template($tmpl);
	$this->table->set_empty("&nbsp;");
	$pretty = $this->table->make_columns($TABLE,2);
	
	echo $this->table->generate($pretty);



}else{
	echo "Sorry, no search results matched that query!";
}


