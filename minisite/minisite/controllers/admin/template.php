<?php
defined('BASEPATH') OR  exit('No direct script access allowed');

Class Template extends My_Admin_Controller{
	public function __construct(){
		parent::__construct();
		// $this->load->help('file');     										  error 
		$this->load->helper('file');
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		//$this->load->model(array('template_baseinfo'));						  error
		$this->load->model(array('template_baseinfo_model'));
	}
	public function index(){
		$data = '<html>
<head>
<title>{content}</title>
</head>
<body>

<h3 style="color:red;">{title}</h3>

</body>
</html>';
		$path = './minisite/views/template/template3.php';

		//if(!wirte_file($path,$data)){    											 error
		if(!write_file($path,$data)){
			var_dump('data insert failed!');exit;

		}else {
			var_dump('data insert success!');exit;

		}
		
	}
	public function showlist() {
		$templates_result = $this->template_baseinfo_model->get_templates();
		foreach ($templates_result as $key => $template) {
			$templates_list[$template['id']] = array(
				'id'      => $template['id'],
				'name' 	  => $template['name'],
			);
		}
		$data['templates_list'] = $templates_list;
		$this->load->view('admin/template_list',$data);

	}
	public function edit($id = false){
		//$this->form_validation->setrules('name','required');      				   error
		//$this->form_validation->setrules('content','required');
		if(!empty($id) && !is_numeric($id)) {
			show_404();
		}
		$this->form_validation->set_rules('name','required');
		$this->form_validation->set_rules('content','required');
		$data = array(
			//'name'    => '';														error
			'name'    => '',												
			'content' => ''
		);
		
		if($id){
			$data = $this->template_baseinfo_model->find($id);
			if(empty($data)){
				show_404();
			}
			$data['id'] = $id;
			$update = array(
				// 'name' 		=> $data['name'],									error
				// 'content' 	=> $data['content']
				'name'    => $this->input->post('name'),
				'content' => $this->input->post('content')

			);
		}else{
			//$data = array(														enhance
			$insert = array(
				'name'    => $this->input->post('name'),
				'content' => $this->input->post('content')
			);
		}
		if(!$this->input->post()){
			//$this->load->views();                                                   error
			$this->load->view('admin/template_edit',$data);
			return;
		}
		if($this->form_validation->run() == false) {
			$this->load->view('admin/template_edit',$data);
			return;	
		}else{
			if($id) {
				$this->template_baseinfo_model->update($update,array('id'=>$id));
			}else{
				$path = './minisite/views/template/'.$insert['name'].'.php';
				$template_content = $insert['content'];

				//if(!wirte_file($path,$data)){    											 error
				if(!write_file($path,$template_content)){
					var_dump('data insert failed!');exit;

				}else {
					//var_dump('data insert success!');exit;
					$this->template_baseinfo_model->insert($insert);

				}
				

			}
			redirect('/admin/template/showlist');

		}


	}

}