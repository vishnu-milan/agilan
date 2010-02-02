<?php
session_start();

class Blog extends Controller {

	function Blog()
	{
		parent::Controller();	
		
		if ($_SESSION['userid'] <= 0){
			redirect('/welcome/index', 'refresh');
		}
		
		
	}
	
	function index(){
		$data['title'] = 'Blog';
		$data['main_view'] = 'blog/blog_home';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $this->m_posts->list_posts();
		//$data['blog_tags'] = $this->m_tags->list_tag_objects("posts");
		//$data['comments'] = $this->m_comments->list_comments(array_keys($data['results']),'posts');
		$data['usernames'] = $this->m_users->list_user_names();
		$this->load->vars($data);
		$this->load->view('template');
	}
	

	function view_post($id){
		$post = $this->m_posts->get_post($id);
		$data['title'] = $post->title;
		$data['main_view'] = 'blog/view_blog';
		$data['user'] = $_SESSION['logged_in_user'];
		$data['results'] = $post;
		$data['usernames'] = $this->m_users->list_user_names();
		$data['post_tags'] = $this->m_tags->list_tag_objects_single($id,'posts');
		$data['comments'] = $this->m_comments->list_comments_single($id,'posts');
		$this->load->vars($data);
		$this->load->view('template');
	
	}

	function update(){
		$data['title'] = 'Add Blog Post';
		$data['main_view'] = 'blog/add_blog';
		$data['user'] = $_SESSION['logged_in_user'];
		$this->load->vars($data);
		$this->load->view('template');		
	
	}
	
	function insert(){

		$try = $this->m_posts->add_post();
		$tags = xss_clean(substr($_SESSION['p_tags'],0,255));
		$this->m_tags->add_tags($tags,'posts',$try);

		redirect("blog/index", 'refresh');
	}	
}

/* End of file bookmarks.php */
/* Location: ./system/application/controllers/agilan.php */