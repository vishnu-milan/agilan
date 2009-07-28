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
		
	}
	
	function index(){
		$data['title'] = 'Welcome to your intranet!';
		$data['main_view'] = 'agilan/home';
		$data['sidebar1'] = 'agilan/sidebar1';
		$data['sidebar2'] = 'agilan/sidebar2';
		$data['user'] = $_SESSION['logged_in_user'];
		$following = $this->m_follows->get_following($_SESSION['userid']);
		$following[] = $_SESSION['userid'];
		$data['updates'] = $this->m_updates->list_updates($following);
		$this->load->vars($data);
		$this->load->view('template');
	}
	

	function edit_profile(){
		$data['title'] = 'Edit Your Profile';
		$data['main_view'] = 'agilan/profile_edit';
		$data['sidebar1'] = 'agilan/sidebar1';
		$data['sidebar2'] = 'agilan/sidebar2';
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
		$this->m_users->update_user($id);
		$_SESSION['logged_in_user'] = $this->m_users->get_user($id);
		redirect("agilan/index", 'refresh');
	}

	
	function search(){
		$input = $this->input->post('searchterm');
		$data['results'] = $this->m_users->search_users($input);
		$data['title'] = 'Search Results';
		$data['main_view'] = 'agilan/search_results';
		$data['sidebar1'] = 'agilan/sidebar1';
		$data['sidebar2'] = 'agilan/sidebar2';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');	
	}
	
}

/* End of file agilan.php */
/* Location: ./system/application/controllers/agilan.php */