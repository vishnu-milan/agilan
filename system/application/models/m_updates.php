<?php
/*
CREATE TABLE `updates` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`update` VARCHAR( 140 ) NOT NULL ,
`user_id` INT NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;

*/
class m_updates extends Model{
	
	function m_updates(){
		parent::Model();
	}
	
	//LIST USERS
	function list_updates($userid){
		$this->db->order_by('created','asc');
		$this->db->limit(100);
		$this->db->where('user_id',$userid);
		$Q = $this->db->get("updates");
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
	
	//GET A USER
	function get_update($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('updates');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}else{
			$data = array();
		}
		
		$Q->free_result();		
		return $data;		
	}
	

	//ADD UPDATE TO DB
	function add_update($status){
		$userid = $_SESSION['userid'];
		$now = date("Y-m-d h:i:s");
		$data = array(
			'update' => xss_clean(substr($status,0,140)),
			'user_id' => $userid,
			'created' => $now
		);
		
		$this->db->insert("updates",$data);
	}
	
	
	function search_updates($input){
		$term = xss_clean(substr($input,0,255));
		$this->db->select('id,user_id,udpate');
		$this->db->like('udpate', $term);
		$Q = $this->db->get("updates");
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

	
	
}//end class

?>