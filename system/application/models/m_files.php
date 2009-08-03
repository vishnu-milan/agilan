<?php
/*
CREATE TABLE `files` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT NOT NULL ,
`title` VARCHAR( 255 ) NOT NULL ,
`description` VARCHAR( 255 ) NOT NULL ,
`location` VARCHAR( 255 ) NOT NULL ,
`file_type` VARCHAR( 128 ) NOT NULL ,
`file_size` VARCHAR( 16 ) NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;
*/
class m_files extends Model{
	
	function m_files(){
		parent::Model();
	}
	
	function list_files($userid){
	
	}
	
	function get_file($id){
	
	}
	
	function delete_file($id){
	
	}
	
	function add_file(){
	
	}
	
	function update_file($id){
	
	}
	
}//end class

?>