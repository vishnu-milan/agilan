<?php
session_start();

class Updates extends Controller {

	function Updates()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
				
	}
	
	function index(){
		$this->m_updates->add_update($this->input->post('status'));
		redirect('agilan/index', 'refresh');
	}
	


	
}

/* End of file updates.php */
/* Location: ./system/application/controllers/updates.php */