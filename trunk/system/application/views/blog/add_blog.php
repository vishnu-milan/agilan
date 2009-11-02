<script type="text/javascript">
	//initiate validator on load
	$(function() {
		
		// validate contact form on keyup and submit
		$("#addBlog").validate({
			//set the rules for the fild names
			rules: {
				title: {
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
				title: "Please enter a title",
				tags: "Please enter at least one tag",
			}
		});
	});
</script>

<?php
/*
needs: form validation
*/


echo heading("Add Blog Post", 2);
$attributes = array('id' => 'addBlog');
echo form_open('blog/insert',$attributes);

echo form_label('Title', 'title');
$input = array('name' => 'title', 'id' => 'title', 'size'=> 40);
echo form_input($input);


echo form_label('Body', 'body');
$input = array('name' => 'body', 'id' => 'body', 'rows'=> 10, 'cols' => 35);
echo form_textarea($input);

tag_field();


echo br(2);
echo form_submit('add','add');

echo form_close();

?>