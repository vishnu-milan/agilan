<?php
/*
CREATE TABLE `messages` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`respond_id` INT NULL ,
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
			foreach ($Q->result() as $row){
				$data[] = $row;
			}
		}else{
			$data = array();
		}
		
		//echo $this->db->last_query();
		$Q->free_result();		
		return $data;		
	}

	function list_messages_from($userid){
		$this->db->where('from_id',$userid);
		$this->db->where('location','sent');
		$Q = $this->db->get("messages");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
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
			$data = $Q->row();
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
	
	function move_message($id,$location='archived'){
		$data = array("location" => $location);
		$this->db->where('id',$id);
		$this->db->update('messages',$data);
	
	}
	
	function send_message($userid){
		$now = date("Y-m-d h:i:s");
		$data = array(
			'from_id' => $userid,
			'to_id' => $this->input->post('to_id'),
			'subject' => xss_clean(substr(strip_tags($this->input->post('subject')),0,64)),
			'message' => xss_clean(substr(strip_tags($this->input->post('message'), '<b><i><a>'),0,255)),
			'created' => $now,
			'location' => 'sent'
		);
		
		$this->db->insert("messages",$data);
	
	}
	
}//end class

?>