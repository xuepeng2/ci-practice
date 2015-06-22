<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Front_Controller {

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
	public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        //$this->lang->load('course');
        $this->load->model(array(
            'article_baseinfo_model'
        ));
    }

	public function observe($id = false)
	{
		if(is_numeric($id)) {
			$data = $this->article_baseinfo_model->find($id);
		}else{
			show_404();
		}

		$this->parser->parse('template/'.$data['template'],$data);
	 
 
	}
}
