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
`photo` MEDIUMBLOB NOT NULL
) ENGINE = MYISAM ;

*/
class m_users extends Model{
	
	function m_users(){
		parent::Model();
	}
	
	//LIST USERS
	function list_users(){
		$data = array();
		$this->db->order_by('lastname','asc');
		$Q = $this->db->get("users");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[] = $row;
			}
		}
		
		$Q->free_result();		
		return $data;	
	}


	//GET USERNAMES
	function list_user_names(){
		$data = array();
		$this->db->select("id,username");
		$this->db->order_by('username','asc');
		$Q = $this->db->get("users");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$data[$row->id] = $row->username;
			}
		}
		$Q->free_result();		
		return $data;	
	}
	
	//GET A USER
	function get_user($id){
		$data = array();
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}
		
		unset($data['tags']);
		$data['tags'] = $this->get_user_tags($id);

		
		$Q->free_result();		
		return $data;		
	}

	function get_user_short($id){
		$data = array();
		$this->db->select('id,username,firstname,lastname,email,phone');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
				
		$Q->free_result();		
		return $data;		
	}


	//GET USER TAGS
	function get_user_tags($id){
		$this->db->select('tag');
		$this->db->where('object','users');
		$this->db->where('object_id',$id);
		$Q = $this->db->get('tags');
		
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$tags[] = $row->tag;
			}
		}		
		
		//print_r($tags);
		
		$tags  = implode("," , $tags);	
		return $tags;
	}

	//GET A USER BY USERNAME
	function get_user_by_username($username){
		$data = array();
		$this->db->where('username',$username);
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}
		unset($data['tags']);
		$data['tags'] = $this->get_user_tags($data['id']);

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

	//COUNT USERS
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
		
		if ($usercount == 0){
			$now = date("Y-m-d h:i:s");
			$data = array(
				'firstname' => xss_clean(substr($this->input->post('firstname'),0,255)),
				'lastname' => xss_clean(substr($this->input->post('lastname'),0,255)),
				'status' => 'active',
				'email' => xss_clean(substr($this->input->post('email'),0,255)),
				'phone' => xss_clean(substr($this->input->post('phone'),0,16)),
				'bio' => xss_clean(substr($this->input->post('bio'),0,5000)),
				'created' => $now,
				'username' => xss_clean($username),
				'password' => md5($random)
			);

			if ($_FILES['photo']['size'] > 0){
				$fname = $_FILES['photo']['name'];
				$fsize = $_FILES['photo']['size'];
				$ftype = $_FILES['photo']['type'];
				$ftemp = $_FILES['photo']['tmp_name'];
				
				$fp = fopen($ftemp,'r');
				$content = fread($fp, filesize($ftemp));
				fclose($fp);
				
				$data['photo'] = base64_encode($content);
			}

			
			$this->db->insert("users",$data);
			$last_insert_id = $this->db->insert_id();
			
			$_SESSION['random_pw'] = $random;
			$_SESSION['username'] = $username;
			$_SESSION['tags'] = $this->input->post('tags');

			
			return $this->db->insert_id();

		}else{
			return 0;
		}
	}
	
	
	//UPDATE USER
	function update_user($id){

		$data = array(
			'firstname' => xss_clean(substr($this->input->post('firstname'),0,255)),
			'lastname' => xss_clean(substr($this->input->post('lastname'),0,255)),
			'phone' => xss_clean(substr($this->input->post('phone'),0,16)),
			'bio' => xss_clean(substr($this->input->post('bio'),0,5000)),
		);

		if (strlen($this->input->post('password'))){
			$data['password'] = md5($this->input->post('password'));
		}			
			
		if ($_FILES['photo']['size'] > 0){
			$fname = $_FILES['photo']['name'];
			$fsize = $_FILES['photo']['size'];
			$ftype = $_FILES['photo']['type'];
			$ftemp = $_FILES['photo']['tmp_name'];
			
			$fp = fopen($ftemp,'r');
			$content = fread($fp, filesize($ftemp));
			fclose($fp);
			
			$data['photo'] = base64_encode($content);
		}


		$this->db->where('id',$id);
		$this->db->update('users',$data);
			
		$_SESSION['tags'] = $this->input->post('tags');
			
		return $id;
					
	}


	//SEARCH USERS
	function search_users($input,$users_from_tags){
		$data = array();
		$term = xss_clean(substr($input,0,255));
		$this->db->select('id,username,firstname,lastname,email,phone');
		$this->db->like('firstname', $term);
		$this->db->orlike('lastname', $term);
		$this->db->orlike('email', $term);
		$this->db->orlike('phone', $term);
		$this->db->orlike('bio', $term);
		$this->db->where('status','active');	
		$Q = $this->db->get("users");
		if ($Q->num_rows() > 0){
			foreach ($Q->result() as $row){
				$ID = $row->id;
				$data[$ID] = $row;
			}
		}
		
		if (count($users_from_tags)){
			foreach ($users_from_tags as $mid => $truth){
				if (!isset($data[$mid])){
					$data[$mid] = $this->get_user_short($mid);
				}
			}
		}
		
		
		$Q->free_result();		
		return $data;	
	}

	
	//DELETE USER
	function delete_user($id){
		$data = array('status'=>'inactive');
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	}
	
	
	
	function get_profile_photo($id){
		$this->db->select('photo');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$Q = $this->db->get('users');
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}		
		//echo $this->db->last_query();
		echo base64_decode($data->photo);

	}

	
}//end class

?>