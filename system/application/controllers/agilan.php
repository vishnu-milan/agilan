<?php
session_start();

class Agilan extends Controller {

	function Agilan()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
	}
	
	function index(){
		echo "you are logged in!";
	}
	

	
}

/* End of file agilan.php */
/* Location: ./system/application/controllers/welcome.php */