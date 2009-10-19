<?php

echo heading("My Files", 2);

echo form_open_multipart('files/upload');
echo form_hidden("MAX_FILE_SIZE",'12000000');
echo "<input type='file' name='userfile' id='userfile' size='30' />";
echo br();
echo form_submit('upload','upload');
echo form_close();
echo br();

$TABLE = array();

//time format!
$format = "%m/%d/%Y %h:%i %a";

if (count($results)){
	foreach ($results as $key => $list){
		$string = $list->title . br();
		$stamp = mysql_to_unix($list->created);
		$string .=  anchor("files/view_file/".$list->id, 'see details') .' | ';
		$string .=  anchor("files/download/".$list->id, 'download') . br();
		$string .= "<small>uploaded " . mdate($format,$stamp);
		$string .= " by ". $usernames[$list->user_id]. br();		
		$string .= "</small>";

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



}

?>