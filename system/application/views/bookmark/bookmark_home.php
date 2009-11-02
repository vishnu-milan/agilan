<script type="text/javascript">
	//initiate validator on load
	$(function() {
		
		// validate contact form on keyup and submit
		$("#addBookmark").validate({
			//set the rules for the fild names
			rules: {
				url: {
					required: true,
					minlength: 2
				},
				tags: {
					required: true,
					minlength: 1
				},

				
			},
			//set messages to appear inline
			messages: {
				url: "Please enter a URL",
				tags: "Please enter at least one tag",
			}
		});
	});
</script>

<?php

echo heading("My Bookmarks", 2);
$attributes = array('id' => 'addBookmark');
echo form_open('bookmarks/update',$attributes);
$input = array('name' => 'url', 'id' => 'url', 'size'=> 20);
echo form_input($input);
echo form_submit('add bookmark','add');
echo form_close();
echo br();

//time format!
$format = "%m/%d/%Y %h:%i %a";


if (count($results)){
	foreach ($results as $key => $list){
		echo auto_link($list->url,'url',TRUE) . br();
		$stamp = mysql_to_unix($list->created);
		echo  anchor("bookmarks/view_bookmark/".$list->id, 'see details') . br();

		echo "<small>posted " . mdate($format,$stamp);
		echo " by ". $usernames[$list->user_id]. br();
		echo "</small>";



		echo br(2);


	}

}

?>