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
	
	function list_messages_to($userid,$location='inbox'){
		$this->db->where('to_id',$userid);
		$this->db->where('location',$location);
		$Q = $this->db->get("messages");
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

	function list_messages_from($userid){
		$this->db->where('from_id',$userid);
		$this->db->where('location','sent');
		$Q = $this->db->get("messages");
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


	function get_message($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('messages');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}else{
			$data = array();
		}
		
		$Q->free_result();		
		return $data;			
	}
	
	function delete_message($id){
		$this->db->limit(1);
		$this->db->where('id', $id);
		$this->db->delete('messages');	
	
	}
	
	function move_message($id,$location){
		$data = array("location" => $location);
		$this->db->where('id',$id);
		$this->db->update('messages',$data);
	
	}
	
	function send_message(){
	
	}
	
}//end class

?>