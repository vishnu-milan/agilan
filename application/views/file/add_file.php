<script type="text/javascript">
	//initiate validator on load
	$(function() {
		
		// validate contact form on keyup and submit
		$("#addFile").validate({
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
needs: form validation, upload of photo
*/


echo heading("Add File Details", 2);
$attributes = array('id' => 'addFile');
echo form_open('files/add_details',$attributes);


echo form_hidden('id',$file_id);

echo form_label('Title', 'title');
$input = array('name' => 'title', 'id' => 'title', 'size'=> 40);
echo form_input($input);


echo form_label('Description', 'description');
$input = array('name' => 'description', 'id' => 'description', 'rows'=> 10, 'cols' => 35);
echo form_textarea($input);

tag_field();



echo br(2);
echo form_submit('add','add');

echo form_close();

?>