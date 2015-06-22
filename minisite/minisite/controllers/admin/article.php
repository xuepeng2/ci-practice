<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Admin_Controller {

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
        //$this->lang->load('course');
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->load->model(array(
            'article_baseinfo_model'
        ));
    }
	public function index()
	{

		//$this->load->model('article_baseinfo_model');
		//$this->load->helper(array('form'));
		$article_all = $result = $this->article_baseinfo_model->get_articles();
		// $data['title'] = "My Real Title";
 	// 	 $data['content'] = "My Real Heading";
		//var_dump($article_all[0]);exit;
		foreach ($article_all as $id => $simple_article_info) {
			$article_list[$id] = array(
				'ID' => $simple_article_info['ID'],
				'title' => $simple_article_info['title'],
				'content' => $simple_article_info['content'],
				'template' => $simple_article_info['template'],
			);
		}
		$data['article_list'] = $article_list;
		$this->load->view('admin/article_list',$data);
		//$this->load->view('admin/article_list');
 
	}
	public function edit($id = false)
	{

		//$this->load->helper(array('form'));
		
		//$this->load->view('admin/article_edit',$data);
		if (!empty($id) && !is_numeric($id)) {
            show_404();
        }

        $this->form_validation->set_rules('title', '标题', 'required');
        $this->form_validation->set_rules('content', '内容', "required");
        $this->form_validation->set_rules('template', '模板', 'required');

        $data = array(
            'title'            => '',
            'content'          => '',
            'template'         => ''
        );
       

        if ($id) {
            $data = $this->article_baseinfo_model->find($id);
            $data['id'] = $id;
            if (empty($data)) {
                show_404();
            }
            $update = array(
                'title'    			=> $this->input->post('title'),
                'content'           => $this->input->post('content'),
                'template'          => $this->input->post('template')
            );
        } else {
            $insert = array(
                'title'    			=> $this->input->post('title'),
                'content'           => $this->input->post('content'),
                'template'          => $this->input->post('template')
            );
        }
 		if(!$this->input->post()) {
        	$this->load->view('admin/article_edit', $data);
        	return;

        }
        if (FALSE == $this->form_validation->run()) {
            $this->load->view('admin/article_edit', $data);

            return;
        } else {
            if ($id) {
                $this->article_baseinfo_model->update($update, array('id'=>$id));
            } else {
                $this->article_baseinfo_model->insert($insert);
            }
            redirect('/admin/article');
        }
 
	}
}
