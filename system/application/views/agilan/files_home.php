<?php

echo heading("My Files", 2);

echo form_open_multipart('files/upload');
echo form_hidden("MAX_FILE_SIZE",'12000000');
echo "<input type='file' name='userfile' id='userfile' size='20' />";
echo form_submit('upload','upload');
echo form_close();
echo br();


//time format!
$format = "%m/%d/%Y %h:%i %a";

if (count($results)){
	foreach ($results as $key => $list){
		echo $list->title . br();
		$stamp = mysql_to_unix($list->created);
		echo  anchor("files/view_file/".$list->id, 'see details') .' | ';
		echo  anchor("files/download/".$list->id, 'download') . br();
		echo "<small>uploaded " . mdate($format,$stamp). br();
		echo "</small>";

		echo br(2);


	}

}

?>