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
		$data['sidebar1'] = 'agilan/sidebar1';
		$data['sidebar2'] = 'agilan/sidebar2';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $this->m_users->list_users();
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

}

/* End of file agilan.php */
/* Location: ./system/application/controllers/agilan.php */