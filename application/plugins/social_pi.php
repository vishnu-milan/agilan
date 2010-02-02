<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function tag_field($value=''){
	$string = form_label('Tags', 'tags');
	$input = array('name' => 'tags', 'id' => 'tags', 'size'=> 40, 'value' => $value);
	$string = form_input($input);
	echo $string;
}

function show_tags($tags,$object_id){
	$string = "<small>Tags: ";
	if (isset($tags[$object_id]) && count($tags[$object_id])){
		$string .= implode(",",$tags[$object_id]);
	}
	$string .= "</small>";
	echo $string;
}

function comments($comments,$object_id,$object,$usernames,$format,$return='agilan/index'){
	$string = "";

	$string .= "<ol class='comments'>";
	if (isset($comments[$object_id]) && count($comments[$object_id]) > 0){
		foreach ($comments[$object_id] as $kk => $ll){
			$CID = $ll->user_id;
			$CU = $usernames[$ll->user_id];
			
			$stamp = mysql_to_unix($ll->created);
			
			$string .= "<li><b>".$CU . ":</b> <small>" .
				$ll->comment . "<br/>".
				mdate($format,$stamp) . "</small></li>";
		}
	}else{
		$string .= nbs();
	}
	
	$string .= "<li class='last'>";
	$string .= form_open('comments/index');
	$input = array('name' => 'comment', 'id' => 'comment', 'size'=> 35);
	$string .= form_input($input);
	$string .= form_hidden('object',$object);
	$string .= form_hidden('object_id',$object_id);
	$string .= form_hidden('return_url',$return);
	$string .= form_submit('add comment','comment');
	$string .= form_close();
	$string .= "</li>";
	$string .= "</ol>";

	echo $string;

}

?>