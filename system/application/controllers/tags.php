<?php
session_start();

class Tags extends Controller {

	function Tags()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		
	}
	
	function index(){
		$this->m_tags->follow_tag($this->input->post('tag'));
		redirect('agilan/index', 'refresh');
	}
	


}

/* End of file tags.php */
/* Location: ./system/application/controllers/agilan.php */