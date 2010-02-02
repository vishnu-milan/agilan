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
/*
needs: form validation, upload of photo
*/


echo heading("Add Bookmark", 2);
$attributes = array('id' => 'addBookmark');
echo form_open('bookmarks/insert',$attributes);

echo form_label('URL', 'url');
$input = array('name' => 'url', 'id' => 'url', 'size'=> 40, 'value' => $url);
echo form_input($input);


echo form_label('Description', 'description');
$input = array('name' => 'description', 'id' => 'description', 'rows'=> 10, 'cols' => 35);
echo form_textarea($input);

tag_field();


echo br(2);
echo form_submit('add','add');

echo form_close();

?>