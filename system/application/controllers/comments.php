<?php
session_start();

class Comments extends Controller {

	function Comments()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
				
	}
	
	function index(){
		//to use this feature please pass in
		//a field called objects (must contain a name of a table!)
		//another field called object_id (int represents primary id of table)
		//for example, passing in an object named updates
		//and object_id of 17 will link the comment to update #17
	
		$return = '';
		if (isset($_POST['return_url'])){
			$return = $this->input->post('return_url');
		}
	
		$try = $this->m_comments->add_comment();
		
		if ($try == 0){
			$_SESSION['message'] = 'Comment failed to post. Try again!';
		}else{
			$_SESSION['message'] = 'Comment posted!';

		}
		
		if (strlen($return)){
			redirect($return,'refresh');
		}else{
			redirect('agilan/index','refresh');
		}
	}

	
}

/* End of file updates.php */
/* Location: ./system/application/controllers/updates.php */