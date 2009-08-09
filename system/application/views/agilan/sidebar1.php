<?php
echo heading("Welcome, " . $user['firstname'],3);
echo br(2);
?>

<?php 
echo heading("My Tags", 4); 

echo form_open('tags/index');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20);
echo form_input($input);
echo br();
echo form_submit('add tag','add tag');
echo form_close();


if (isset($_SESSION['my_follow_tags']) && count($_SESSION['my_follow_tags'])){
	foreach ($_SESSION['my_follow_tags'] as $key => $tag){
		echo anchor("agilan/show_objects/".$tag, $tag) . br();
	}
}
?>

<?php echo heading("My Bookmarks", 4); ?>

bookmarks go here

<?php echo heading("Upload files",4); ?>