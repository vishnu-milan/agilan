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
		$data['title'] = 'List of Tags';
		$data['main_view'] = 'agilan/tags_home';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $this->m_tags->list_tags();
		$this->load->vars($data);
		$this->load->view('template');
	}

	
	function update(){
		$this->m_tags->follow_tag($this->input->post('tag'));
		redirect('tags/index', 'refresh');
	}
	
	function objects($tag){
		$data['results'] = $this->m_tags->list_objects($tag);
		$data['tagname'] = $tag;
		$data['title'] = 'Show Tag Results: '. $tag;
		$data['main_view'] = 'agilan/tag_results';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');
	
	}

}

/* End of file tags.php */
/* Location: ./system/application/controllers/agilan.php */