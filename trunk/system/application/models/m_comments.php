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
	
	function list_comments($list_of_ids,$object){
		$data = array();
		$this->db->select('id,object_id,comment,user_id,created');
		$this->db->where_in("object_id",$list_of_ids);
		$this->db->where('object',$object);
		$this->db->order_by('created','asc');
		$Q = $this->db->get("comments");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->object_id][$row->id] = $row;
			}
		}
		$Q->free_result();		
		return $data;		
	}
	
	function add_comment(){
		
		if ($this->input->post('object_id') <= 0 or strlen($this->input->post('comment')) <= 0 or
			strlen($this->input->post('object')) <= 0){
			
			return 0;
		}else{
			$userid = $_SESSION['userid'];
			$now = date("Y-m-d h:i:s");
			$data = array(
				'comment' => xss_clean(substr($this->input->post('comment'),0,255)),
				'object' => xss_clean($this->input->post('object')),
				'object_id' => $this->input->post('object_id'),
				'user_id' => $userid,
				'created' => $now
			);
			
			$this->db->insert("comments",$data);
			return 1;
		}
	}
}//end class

?>