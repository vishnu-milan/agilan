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
`created` TIMESTAMP NOT NULL,
`content` MEDIUMBLOB NOT NULL
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
			foreach ($Q->result() as $row){
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
			$data = $Q->row();
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

		if ($_FILES['userfile']['size'] > 0){
			$fname = $_FILES['userfile']['name'];
			$fsize = $_FILES['userfile']['size'];
			$ftype = $_FILES['userfile']['type'];
			$ftemp = $_FILES['userfile']['tmp_name'];
			
			$fp = fopen($ftemp,'r');
			$content = fread($fp, filesize($ftemp));
			fclose($fp);
			
			$data['content'] = base64_encode($content);
			$data['file_type'] = $ftype;
			$data['file_size'] = $fsize;

		}


		$this->db->insert('files',$data);
		return $this->db->insert_id();

		/* deprecated!
		
		if (count($_FILES['userfile'])){
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|doc|xls|zip|txt|html|rtf';
			$config['max_size']	= '3500';
			$config['max_width']  = '800';
			$config['max_height']  = '800';
			$this->load->library('upload', $config);
	
			if(!$this->upload->do_upload()){
				echo $this->upload->display_errors();
				exit();
			}
			$this->upload->do_upload();
			$U = $this->upload->data();
			return $U['file_name'];
		}else{
			return 0;
		}
		*/
	}
	
	function add_details(){
		$fid = $this->input->post('id');
		$userid = $_SESSION['userid'];
		$now = date("Y-m-d h:i:s");
		$data = array(
			'title' => xss_clean(substr($this->input->post('title'),0,255)),
			'description' => xss_clean(substr($this->input->post('description'),0,255)),
			'location' => $this->input->post('location'),
			'user_id' => $userid,
			'created' => $now
		);
		
		$this->db->where('id',$fid);
		$this->db->update("files",$data);
		$_SESSION['f_tags'] = $this->input->post('tags');
		
		return $fid;
	}
	
	
	function get_name($id){
		$data = array();
		$this->db->select('title');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('files');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		
		$Q->free_result();		
		return $data->title;					
	}

	function get_data($id){
		$data = array();
		$this->db->select('content');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('files');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		
		$Q->free_result();		
		echo base64_decode($data->content);					
	}
	
}//end class

?>