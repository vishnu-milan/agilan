<?php
/* needs: cleaned up udpates, updates that gets following's updates
*/

echo heading("What is your status?", 2);

echo form_open('updates/index');
$input = array('name' => 'status', 'id' => 'status', 'size'=> 40);
echo form_input($input);
echo form_submit('update','update');
echo form_close();


if (count($updates)){
	print_r($updates);

}
?>