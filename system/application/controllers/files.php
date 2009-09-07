<?php
session_start();

class Files extends Controller {

	function Files()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		
	}
	
	function index(){
		$data['title'] = 'List of Files';
		$data['main_view'] = 'agilan/files_home';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $this->m_files->list_files($_SESSION['userid']);
		$data['file_tags'] = $this->m_tags->list_tag_objects("files");
		$data['comments'] = $this->m_comments->list_comments(array_keys($data['results']),'files');
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}
	

	function download($id){
		$name = $this->m_files->get_location($id);
		$data = file_get_contents("./uploads/".$name);
		force_download($name,$data);
	}

	function upload(){
		$try = $this->m_files->add_file();
		

		if ($try == '0'){
			echo "No file uploaded!";
			exit();
		}else{
			$data['location'] = $try;
		}

		$data['title'] = 'Add File Details';
		$data['main_view'] = 'agilan/add_file';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');		

	}
	
	function insert(){
		$try = $this->m_files->insert_file();
		$tags = xss_clean(substr($_SESSION['f_tags'],0,255));
		$this->m_tags->add_tags($tags,'files',$try);
		redirect("files/index", 'refresh');
	}	
	
	
}

/* End of file bookmarks.php */
/* Location: ./system/application/controllers/agilan.php */