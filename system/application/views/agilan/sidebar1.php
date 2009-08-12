<?php
echo heading("Welcome, " . $user['firstname'],3);
echo br(2);
?>

<?php 
echo anchor("tags/index","my tags");
echo br(2);

echo form_open('tags/update');
$input = array('name' => 'tag', 'id' => 'tag', 'size'=> 20);
echo form_input($input);
echo br();
echo form_submit('add tag','add tag');
echo form_close();

echo br(3);

echo anchor("bookmarks/index","my bookmarks");
echo br(2);
echo form_open('bookmarks/update');
$input = array('name' => 'url', 'id' => 'url', 'size'=> 20);
echo form_input($input);
echo br();
echo form_submit('add bookmark','add bookmark');
echo form_close();

?>


<?php echo heading("Upload files",4); ?>