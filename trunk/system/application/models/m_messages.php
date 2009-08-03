<?php
/*
CREATE TABLE `messages` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`from_id` INT NOT NULL ,
`to_id` INT NOT NULL ,
`subject` VARCHAR( 64 ) NOT NULL ,
`message` VARCHAR( 255 ) NOT NULL ,
`location` ENUM( 'inbox', 'sent', 'archived' ) NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;
*/
class m_messages extends Model{
	
	function m_messages(){
		parent::Model();
	}
	
	function list_messages($userid){
	
	}
	
	function get_message($id){
	
	}
	
	function delete_message($id){
	
	}
	
	function move_message($id,$target){
	
	}
	
}//end class

?>