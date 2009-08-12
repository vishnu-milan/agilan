<?php
echo heading("Welcome, " . $user['firstname'],3);
 
echo anchor("agilan/index",'home');
echo br();
echo anchor("tags/index","my tags");
echo br();
echo anchor("bookmarks/index","my bookmarks");
echo br();
echo anchor("files/index", "my files");
?>

