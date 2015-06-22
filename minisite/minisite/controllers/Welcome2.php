<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome2 extends MY_Front_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->library('parser');

		// $data = array(
		//             'blog_title' => 'My Blog Title',
		//             'blog_heading' => 'My Blog Heading'
		//             );

		// $this->parser->parse('template/blog_template', $data);
		//$this->load->view('front_login');
		$this->load->helper(array('form', 'url'));
  
  		$this->load->library('form_validation');
  		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		 // 经过跨站脚本过滤 返回全部 POST 数据 
    	if($this->input->post(NULL, TRUE)) {
    		 if ($this->form_validation->run() == FALSE)
			  {
			   $this->load->view('front_login');
			  }
			  else
			  {
			   $this->load->view('front_login_success');
			  }

    	}else {
    		$this->load->view('front_login');
    	}
	 
 
	}
}
