<?php
/*
CREATE TABLE `tags` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`tag` VARCHAR( 64 ) NOT NULL ,
`object` VARCHAR( 64 ) NOT NULL ,
`object_id` INT NOT NULL ,
`user_id` INT NOT NULL ,
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
	
	function add_tags($tags,$object,$object_id){
		$tags_array = explode(",",$tags);
		$userid = $_SESSION['userid'];
		$now = date("Y-m-d h:i:s");
		
		foreach ($tags_array as $tag){
			
			$data = array(
				'tag' => xss_clean($tag),
				'object' => $object,
				'object_id' => $object_id,
				'user_id' => $userid,
				'created' => $now
			);
			
			$this->db->insert("tags",$data);			
		
		}
	
	
	}

	
}//end class

?>