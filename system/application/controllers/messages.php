<?php
session_start();

class Messages extends Controller {

	function Messages()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
	}
	
	function index(){
		$data['title'] = 'Your Inbox';
		$data['main_view'] = 'agilan/inbox';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['messages'] = $this->m_messages->list_messages_to($_SESSION['userid']);
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}

	function sent(){
		$data['title'] = 'Sent Messages';
		$data['main_view'] = 'agilan/sent';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['messages'] = $this->m_messages->list_messages_from($_SESSION['userid']);
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}	

	function archive(){
		$data['title'] = 'Your Archives';
		$data['main_view'] = 'agilan/archive';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['messages'] = $this->m_messages->list_messages_to($_SESSION['userid'],'archived');
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}

	function compose(){
		$data['title'] = 'Compose Message';
		$data['main_view'] = 'agilan/compose';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}


	function send_message(){
		$this->m_messages->send_message($_SESSION['userid']);
		redirect('messages/index','refresh');
	
	}
}

/* End of file agilan.php */
/* Location: ./system/application/controllers/agilan.php */