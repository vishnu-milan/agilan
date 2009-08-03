<?php
/*
CREATE TABLE `tags` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`tag` VARCHAR( 128 ) NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;


CREATE TABLE `tags_objects_map` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`tag_id` INT NOT NULL ,
`object` VARCHAR( 64 ) NOT NULL ,
`object_id` INT NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;
*/


class m_tags extends Model{
	
	function m_tags(){
		parent::Model();
	}
	
	function list_all_tags(){
	
	}
	
	function list_objects($tag){
	
	}
	
	function delete_tag($id){
	
	}
	
	function add_tag(){
	
	}

	
}//end class

?>