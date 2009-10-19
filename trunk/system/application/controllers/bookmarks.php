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
		$data['main_view'] = 'bookmark/bookmark_home';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $this->m_bookmarks->list_bookmarks();
		//$data['bookmark_tags'] = $this->m_tags->list_tag_objects("bookmarks");
		//$data['comments'] = $this->m_comments->list_comments(array_keys($data['results']),'bookmarks');
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}
	

	function view_bookmark($id){
		$bookmark = $this->m_bookmarks->get_bookmark($id);
		$data['title'] = $bookmark->url;
		$data['main_view'] = 'bookmark/view_bookmark';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $bookmark;
		$data['usernames'] = $this->m_users->list_user_names();
		$data['bookmark_tags'] = $this->m_tags->list_tag_objects_single($id,'bookmarks');
		$data['comments'] = $this->m_comments->list_comments_single($id,'bookmarks');
		$this->load->vars($data);
		$this->load->view('template');	
	}

	function all(){
		$data['title'] = 'Bookmark Directory';
		$data['main_view'] = 'bookmark/bookmarks_all';
		$data['results'] = $this->m_bookmarks->list_all_bookmarks();
		$data['user'] = $_SESSION['logged_in_user'];
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	
	function update(){
		$data['url'] = prep_url($this->input->post('url'));
		$data['title'] = 'Add Bookmark';
		$data['main_view'] = 'bookmark/add_bookmark';
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