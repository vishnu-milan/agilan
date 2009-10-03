<?php
session_start();

class Users extends Controller {

	function Users()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		$_SESSION['logged_in_user'] = $this->m_users->get_user($_SESSION['userid']);
		
	}
	
	function index(){
		$data['title'] = 'See all users';
		$data['main_view'] = 'agilan/all_users';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['following'] = $this->m_follows->get_following($_SESSION['userid']);
		$data['results'] = $this->m_users->list_users();
		$data['user_tags'] = $this->m_tags->list_tag_users();
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	function home($username){
		$data['title'] = 'See profile for '. $username;
		$data['main_view'] = 'agilan/user_home';
		$data['user'] = $this->m_users->get_user_by_username($username);
		$data['updates'] = $this->m_updates->list_updates($data['user']['id'],10);
		$data['posts'] = $this->m_posts->list_user_posts();
		$data['files'] = $this->m_files->list_user_files();
		$data['bookmarks'] = $this->m_bookmarks->list_user_bookmarks();
		$following = $this->m_follows->get_following($_SESSION['userid']);
		$following[] = $_SESSION['userid'];
		$data['following'] = $following;
		$this->load->vars($data);
		$this->load->view('template');
	}

	function follow($id){
		$myid = $_SESSION['userid'];
		$this->m_follows->follow($myid,$id);
		redirect("agilan/index", 'refresh');
	}

	function unfollow($id){
		$myid = $_SESSION['userid'];
		$this->m_follows->unfollow($myid,$id);
		redirect("agilan/index", 'refresh');
	}	
	
	function get_photo($id){
		$this->m_users->get_profile_photo($id);
	}

}

/* End of file agilan.php */
/* Location: ./system/application/controllers/agilan.php */