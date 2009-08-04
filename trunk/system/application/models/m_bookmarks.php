<?php
/*
CREATE TABLE `bookmarks` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT NOT NULL ,
`url` VARCHAR( 255 ) NOT NULL ,
`description` VARCHAR( 255 ) NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;
*/
class m_bookmarks extends Model{
	
	function m_bookmarks(){
		parent::Model();
	}
	
	function get_bookmark($id){
	
	}
	
	function list_bookmarks(){
		//by tag?
		//by userid?
	}
	
}//end class

?>