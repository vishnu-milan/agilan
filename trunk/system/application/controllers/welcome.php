<?php
session_start();

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index(){
		if (isset($_SESSION['userid']) && $_SESSION['userid'] > 0){
			redirect('/agilan/index','refresh');
		
		}else{
		$data['title'] = 'Please login or register!';
		$data['main_view'] = 'welcome/home';
		$this->load->vars($data);
		$this->load->view('template');

		}
	}
	
	function verify(){
		$u = $this->input->post('username');
		$pw = $this->input->post('password');
		$try = $this->m_users->verify_user($u,$pw);
		
		
		if ($try){
			redirect('/agilan/index','refresh');
		}else{
			redirect('/welcome/index','refresh');
		}
	}
	
	function register(){
		$data['title'] = 'Please register!';
		$data['main_view'] = 'welcome/register';
		$this->load->vars($data);
		$this->load->view('template');	
	}
	
	function create(){
		$try = $this->m_users->add_user();
		
		if ($try){
			$data['title'] = 'Thanks for registering';
			$data['main_view'] = 'welcome/thanks';		
		}else{
			$data['title'] = 'There was a problem!';
			$data['main_view'] = 'welcome/oops';				
		}
		

		$this->load->vars($data);
		$this->load->view('template');	
	
	
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */