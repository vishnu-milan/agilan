<?php
session_start();

class Agilan extends Controller {

	function Agilan()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		$_SESSION['logged_in_user'] = $this->m_users->get_user($_SESSION['userid']);
		$_SESSION['my_follow_tags'] = $this->m_tags->list_tags($_SESSION['userid']);
		$_SESSION['sidebar1'] = 'agilan/sidebar1';
		$_SESSION['sidebar2'] = 'agilan/sidebar2';
	}
	
	function index(){
		$data['title'] = 'Welcome to agilan!';
		$data['main_view'] = 'agilan/home';
		$data['user'] = $_SESSION['logged_in_user'];
		$following = $this->m_follows->get_following($_SESSION['userid']);
		$following[] = $_SESSION['userid'];
		$data['updates'] = $this->m_updates->list_updates($following);
		$data['comments'] = $this->m_comments->list_comments(array_keys($data['updates']),'updates');
		$data['usernames'] = $this->m_users->list_user_names();
		$data['following'] = $following;
		$this->load->vars($data);
		$this->load->view('template');
	}
	

	function edit_profile(){
		$data['title'] = 'Edit Your Profile';
		$data['main_view'] = 'agilan/profile_edit';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');	
	}

	 function logout(){
		unset($_SESSION['userid']);
		redirect('welcome/index','refresh'); 	
	 }

	function update_profile(){
		$id = $_SESSION['userid'];
		$try = $this->m_users->update_user($id);
		
		$tags = xss_clean(substr($_SESSION['tags'],0,255));
		$this->m_tags->add_tags($tags,'users',$try);	
		
		$_SESSION['logged_in_user'] = $this->m_users->get_user($id);
		redirect("agilan/index", 'refresh');
	}

	
	function search(){
		$input = $this->input->post('searchterm');
		$users_from_tags = $this->m_tags->search_tags($input);
		$data['results'] = $this->m_users->search_users($input,$users_from_tags);
		$data['title'] = 'Search Results';
		$data['main_view'] = 'agilan/search_results';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');	
	}



}

/* End of file agilan.php */
/* Location: ./system/application/controllers/agilan.php */