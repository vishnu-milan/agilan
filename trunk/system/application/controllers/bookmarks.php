<?php
session_start();

class Bookmarks extends Controller {

	function Bookmarks()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		
	}
	
	function index(){
		$data['title'] = 'List of Bookmarks';
		$data['main_view'] = 'agilan/bookmark_home';
		$data['sidebar1'] = 'agilan/sidebar1';
		$data['sidebar2'] = 'agilan/sidebar2';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $this->m_bookmarks->list_bookmarks();
		$data['bookmark_tags'] = $this->m_tags->list_tag_objects("bookmarks");
		$this->load->vars($data);
		$this->load->view('template');
	}
	



	function update(){
		$data['url'] = prep_url($this->input->post('url'));
		$data['title'] = 'Add Bookmark';
		$data['main_view'] = 'agilan/add_bookmark';
		$data['sidebar1'] = 'agilan/sidebar1';
		$data['sidebar2'] = 'agilan/sidebar2';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');		
	
	}
	
	function insert(){

		$try = $this->m_bookmarks->add_bookmark();
		$tags = xss_clean(substr($_SESSION['b_tags'],0,255));
		$this->m_tags->add_tags($tags,'bookmarks',$try);

		redirect("bookmarks/index", 'refresh');
	}	
}

/* End of file bookmarks.php */
/* Location: ./system/application/controllers/agilan.php */