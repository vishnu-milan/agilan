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
		$this->db->where('user_id',$userid);
		$Q = $this->db->get("files");
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}else{
			$data = array();
		}
		$Q->free_result();		
		return $data;		
	}
	
	function get_file($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('files');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}else{
			$data = array();
		}
		
		$Q->free_result();		
		return $data;			
	}
	
	function delete_file($id){
		//we need to add a bit in here where the file is removed from the location!
		$this->db->limit(1);
		$this->db->where('id', $id);
		$this->db->delete('files');	
	}
	
	function add_file(){
	
	}
	
	function update_file($id){
	
	}
	
}//end class

?>