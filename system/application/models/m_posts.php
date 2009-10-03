<?php
/*
CREATE TABLE `posts` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT NOT NULL ,
`title` VARCHAR( 255 ) NOT NULL ,
`body` TEXT NOT NULL ,
`created` TIMESTAMP NOT NULL
) ENGINE = MYISAM ;
*/
class m_posts extends Model{
	
	function m_posts(){
		parent::Model();
	}
	

	function list_posts($limit=25){
		$data = array();
		$this->db->select('id,title,created,user_id');
		$this->db->limit($limit);
		$Q = $this->db->get('posts');
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->id] = $row;
			}
		}
		
		$Q->free_result();		
		return $data;			
	}
	
	function list_user_posts($limit=5){
		$userid = $_SESSION['userid'];
		$data = array();
		$this->db->select('id,title,created');
		$this->db->where('user_id',$userid);
		$this->db->limit($limit);
		$Q = $this->db->get('posts');
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->id] = $row;
			}
		}
		
		$Q->free_result();		
		return $data;			
	}
	
	
	function get_post($id){
		$data = array();
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('posts');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		
		$Q->free_result();		
		return $data;		
	}

	function get_post_short($id){
		$data = array();
		$this->db->select('id,title,created,user_id');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('posts');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		
		$Q->free_result();		
		return $data;		
	}
	

	function add_post(){
		$userid = $_SESSION['userid'];
		$now = date("Y-m-d h:i:s");
		$data = array(
			'title' => xss_clean(substr($this->input->post('title'),0,255)),
			'body' => xss_clean(substr($this->input->post('body'),0,5000)),
			'user_id' => $userid,
			'created' => $now
		);
		
		$this->db->insert("posts",$data);
		$_SESSION['p_tags'] = $this->input->post('tags');
		return $this->db->insert_id();
	}
	
	function delete_post($id){
		$this->db->limit(1);
		$this->db->where('id', $id);
		$this->db->delete('posts');	
	}	

	
	
}//end class

?>