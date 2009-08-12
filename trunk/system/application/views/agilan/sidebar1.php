
		<ul id="navlist">
			<li>Welcome <?php echo $user['firstname'];?></li>
			<li><?php echo anchor("agilan/index",'home');?></li>
			<li><?php echo anchor("tags/index","my tags");?></li>
			<li><?php echo anchor("bookmarks/index","my bookmarks");?></li>
			<li><?php echo anchor("files/index", "my files");?></li>
	
			<p>We'll put messages here!</p>
		</ul>