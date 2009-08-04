<?php
/*
CREATE TABLE `comments` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`comment` VARCHAR( 255 ) NOT NULL ,
`object` VARCHAR( 64 ) NOT NULL ,
`object_id` INT NOT NULL ,
`user_id` INT NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;
*/
class m_comments extends Model{
	
	function m_comments(){
		parent::Model();
	}
	
	function get_comments($objectid,$object){
	
	}
	
}//end class

?>