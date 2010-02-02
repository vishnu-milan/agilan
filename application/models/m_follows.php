<?php
/*
CREATE TABLE `follows` (
`follower_id` INT NOT NULL ,
`following_id` INT NOT NULL ,
PRIMARY KEY ( `follower_id` , `following_id` )
) ENGINE = MYISAM ;
*/
class m_follows extends Model{
	
	function m_follows(){
		parent::Model();
	}
	
	function follow($follower_id,$following_id){
		$data = array(
				'follower_id' => $follower_id, 
				'following_id' => $following_id);
		$this->db->insert('follows',$data);
		
	}
	

	
	function unfollow($follower_id,$following_id){
		$this->db->where('follower_id', $follower_id);
		$this->db->where('following_id', $following_id);
		$this->db->delete('follows');
	}
	
	function get_following($follower_id){
		$this->db->select('following_id');
		$this->db->where('follower_id',$follower_id);
		$Q = $this->db->get("follows");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[] = $row->following_id;
			}
		}else{
			$data = array();
		}
		$Q->free_result();		
		return $data;		
	}
	
}//end class

?>