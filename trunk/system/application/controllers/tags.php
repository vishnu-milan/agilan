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

	function all(){
		$data['title'] = 'Tag Directory';
		$data['main_view'] = 'agilan/tags_all';
		$data['results'] = $this->m_tags->list_all_tags();
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');
	}

	
	function update(){
		$this->m_tags->follow_tag($this->input->post('tag'));
		redirect('tags/index', 'refresh');
	}
	
	function objects($tag){
		$temp = $this->m_tags->list_objects($tag);
		
		if (count($temp)){
			foreach ($temp as $id => $obj){
				$obj_id = $obj->object_id;
				switch($obj->object){
					case "bookmarks":
						$results[$obj->object][$obj_id] = $this->m_bookmarks->get_bookmark($obj_id);
					break;
					
					case "files":
						$results[$obj->object][$obj_id] = $this->m_files->get_file_short($obj_id);
					break;
					
					case "users":
						$results[$obj->object][$obj_id] = $this->m_users->get_user_short($obj_id);
					break;
				}
			}		
		}		
		
		$data['results'] = $results;
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