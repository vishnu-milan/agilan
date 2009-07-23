<?php
/*
CREATE TABLE `users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`created` TIMESTAMP NOT NULL
`username` VARCHAR( 128 ) NOT NULL ,
`email` VARCHAR( 255 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
`firstname` VARCHAR( 32 ) NOT NULL ,
`lastname` VARCHAR( 32 ) NOT NULL ,
`phone` VARCHAR( 32 ) NOT NULL ,
`bio` TEXT NOT NULL ,
`tags` VARCHAR( 255 ) NOT NULL ,
`status` ENUM( 'active', 'inactive' ) NOT NULL,
`photo` VARCHAR( 255 ) NOT NULL
) ENGINE = MYISAM ;

*/
class m_users extends Model{
	
	function m_users(){
		parent::Model();
	}
	
	//LIST USERS
	function list_users(){
		$this->db->order_by('username','asc');
		$Q = $this->db->get("users");
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
	function get_user($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}else{
			$data = array();
		}
		
		$Q->free_result();		
		return $data;		
	}
	
	//check validity of email addie!
	function check_valid_email($email){
		$Q = $this->db->query("select username,password from users where email='$email' order by id desc limit 1");
		if ($Q->num_rows() > 0){
			$row = $Q->row();
			return $row->username . " ". $row->password;
		}else {
			return 'nopassword';
		}
	}
	
	//VERIFY IF USER EXISTS
	function verify_user($u,$pw){
		$this->db->select('id,username,email');
		$this->db->where('username',$u);
		$this->db->where('password', md5($pw));
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0){
			$row = $Q->row();
			$_SESSION['userid'] = $row->id;
			$_SESSION['username'] = $row->username;
			$_SESSION['email'] = $row->email;
			return 1;
		}else{
			return 0;
		}		
	}

	function count_user($username,$email){
		$Q = $this->db->query("select count(*) as usercount from users where username='$username' or email='$email'");
		if ($Q->num_rows() > 0){
   			$row = $Q->row();
   			return $row->usercount;
		}	
	
	}

	//ADD USER TO DB
	function add_user(){
		$username = str_replace(" ","_",substr($this->input->post('username'),0,64));
		$email = $this->input->post('email');
		$usercount = $this->count_user($username,$email);
		$random = random_string('alnum', 8);
		
		if ($usercount ==0){
			$now = date("Y-m-d h:i:s");
			$data = array(
				'firstname' => xss_clean(substr($this->input->post('firstname'),0,255)),
				'lastname' => xss_clean(substr($this->input->post('lastname'),0,255)),
				'status' => 'active',
				'email' => xss_clean(substr($this->input->post('email'),0,255)),
				'phone' => xss_clean(substr($this->input->post('phone'),0,16)),
				'tags' => xss_clean(substr($this->input->post('tags'),0,255)),
				'bio' => xss_clean(substr($this->input->post('bio'),0,5000)),
				'created' => $now,
				'username' => xss_clean($username),
				'password' => md5($random)
			);
			
			$this->db->insert("users",$data);
			$_SESSION['random_pw'] = $random;
			$_SESSION['username'] = $username;
			return 1;

		}else{
			return 0;
		}
	}
	
	
	
	function update_user($id){

		$data = array(
			'firstname' => xss_clean(substr($this->input->post('firstname'),0,255)),
			'lastname' => xss_clean(substr($this->input->post('lastname'),0,255)),
			'email' => xss_clean(substr($this->input->post('email'),0,255)),
			'phone' => xss_clean(substr($this->input->post('phone'),0,16)),
			'tags' => xss_clean(substr($this->input->post('tags'),0,255)),
			'bio' => xss_clean(substr($this->input->post('bio'),0,5000)),
		);

		if (strlen($this->input->post('password'))){
			$data = array('password' => $this->input->post('password'));
		}			
			
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		
	}
	
	function delete_user($id){
		$data = array('status'=>'inactive');
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	}

	
}//end class

?>