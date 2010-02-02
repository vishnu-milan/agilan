<?php
session_start();

class Agilan extends Controller {

	// Constructor method
	function Agilan()
	{
		// Call the parent's constructor
		parent::Controller();	
		
		if (!isset($_SESSION['userid']) or $_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		$_SESSION['logged_in_user'] = $this->m_users->get_user($_SESSION['userid']);
		$_SESSION['my_follow_tags'] = $this->m_tags->list_tags($_SESSION['userid']);
		$_SESSION['sidebar1'] 		= 'agilan/sidebar1';
		$_SESSION['sidebar2'] 		= 'agilan/sidebar2';
		$_SESSION['globalnav'] 		= 'agilan/globalnav';
	}
	
	// Index method
	function index(){
		// Setting the required data
		$data['title'] 		= 'Welcome to agilan!';
		$data['main_view'] 	= 'agilan/home';
		$data['user'] 		= $_SESSION['logged_in_user'];
		
		$following 			= $this->m_follows->get_following($_SESSION['userid']);
		$following[] 		= $_SESSION['userid'];
		
		$data['updates'] 	= $this->m_updates->list_updates($following);
		$data['comments'] 	= $this->m_comments->list_comments(array_keys($data['updates']),'updates');
		$data['usernames'] 	= $this->m_users->list_user_names();
		$data['following'] 	= $following;
		
		// Loading vars and views
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	// Method called whenever the user decides to edit his/her profile
	function edit_profile(){
		$data['title'] 		= 'Edit Your Profile';
		$data['main_view'] 	= 'agilan/profile_edit';
		$data['user'] 		= $_SESSION['logged_in_user'];
		
		// Loadings vars and views
		$this->load->vars($data);
		$this->load->view('template');	
	}

	// Method to log the user out
	function logout(){
		unset($_SESSION['userid']);
		redirect('welcome/index','refresh'); 	
	}

	// Method to update the user's profile
	function update_profile(){
		$id  = $_SESSION['userid'];
		$try = $this->m_users->update_user($id);
		
		$tags = xss_clean(substr($_SESSION['tags'],0,255));
		$this->m_tags->add_tags($tags,'users',$try);	
		
		// Update the session and redirect the user
		$_SESSION['logged_in_user'] = $this->m_users->get_user($id);
		redirect("agilan/index", 'refresh');
	}

	// Method to search the site
	function search(){
		$input 				= $this->input->post('searchterm');
		$users_from_tags 	= $this->m_tags->search_tags($input);
		$data['results'] 	= $this->m_users->search_users($input,$users_from_tags);
		$data['title'] 		= 'Search Results';
		$data['main_view'] 	= 'agilan/search_results';
		$data['user'] 		= $_SESSION['logged_in_user'];
		
		// Loading vars and views
		$this->load->vars($data);
		$this->load->view('template');	
	}
}

/* End of file agilan.php */
/* Location: ./system/application/controllers/agilan.php */