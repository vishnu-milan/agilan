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
	
	
	function add_bookmark(){
		$userid = $_SESSION['userid'];
		$now = date("Y-m-d h:i:s");
		$data = array(
			'url' => xss_clean(substr($this->input->post('url'),0,255)),
			'description' => xss_clean(substr($this->input->post('description'),0,255)),
			'user_id' => $userid,
			'created' => $now
		);
		
		$this->db->insert("bookmarks",$data);
		$_SESSION['b_tags'] = $this->input->post('tags');
		return $this->db->insert_id();
	
	}


	function get_bookmark($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('bookmarks');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}else{
			$data = array();
		}
		
		$Q->free_result();		
		return $data;			
	}	
	
	function list_bookmarks(){
		$userid = $_SESSION['userid'];
		$data = array();
		$this->db->where('user_id',$userid);
		$this->db->order_by('created','asc');
		$Q = $this->db->get("bookmarks");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->id] = $row;
			}
		}
		$Q->free_result();		

		return $data;		
	}


	function list_user_bookmarks($limit=5){
		$userid = $_SESSION['userid'];
		$data = array();
		$this->db->where('user_id',$userid);
		$this->db->limit($limit);
		$this->db->order_by('created','asc');
		$Q = $this->db->get("bookmarks");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->id] = $row;
			}
		}
		$Q->free_result();		

		return $data;		
	}

	function list_all_bookmarks(){
		$data = array();
		$this->db->order_by('created','asc');
		$Q = $this->db->get("bookmarks");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->id] = $row;
			}
		}
		$Q->free_result();		

		return $data;		
	}

	
}//end class

?>