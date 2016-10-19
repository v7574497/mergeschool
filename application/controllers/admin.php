<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sa_model');
		$this->load->model('merge_school_model');
		session_start();
	}
	
	public function index(){
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$data['title'] = " - 管理者登入";
		if(!empty($_SESSION['account'])){
			$data['title'] = " - 後台";
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/index', $data);
			$this->load->view('templates/footer');
		}else{
			$this->form_validation->set_error_delimiters('<font class="form_errors">', '</font>');
			$this->form_validation->set_rules('account', '帳號', 'callback_empty_check|callback_account_check');
			$this->form_validation->set_rules('password', '密碼', 'callback_empty_check');
			$this->form_validation->set_rules('code', '驗證碼', 'callback_empty_check|callback_code_check');
			if ($this->form_validation->run() == FALSE)
			{
				if(isset($_SESSION['code'])){
					unset($_SESSION['code']);
				}
				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu', $data);
				$this->load->view('admin/login', $data);
				$this->load->view('templates/footer');
			}else{
				if(isset($_SESSION['code'])){
					unset($_SESSION['code']);
				}
				$this->load->view('admin/login1');
			}
		}
	}

	public function logout(){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper('url');
		$this->load->view('admin/logout');
	}

	public function history($str=""){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper(array('form','url'));
		$data['title'] = " - 管理歷史列";
		$data['history'] = $this->merge_school_model->get_history();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu_admin');
		$this->load->view('admin/history',$data);
		$this->load->view('templates/footer');		
	}

	public function history_insert($id=""){
		if($id!="" || empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper(array('form','url'));
		$data['title'] = " - 新增歷史列";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font>', '</font>');
		$this->form_validation->set_rules('title', '歷史文章主題', 'callback_empty_check');
		$this->form_validation->set_rules('year', '年', 'callback_empty_check');
		$this->form_validation->set_rules('month', '月', 'callback_empty_check');
		$this->form_validation->set_rules('day', '日', 'callback_empty_check');
		$this->form_validation->set_rules('content', '歷史文章內容', 'callback_empty_check');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/history_insert');
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/history_insert1',$data);
		}
	}

	public function history_update($id){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_history_single($id);
		if($query->num_rows()==0){
			show_404();
		}
		$data['history'] = $query->row();
		$query = $this->merge_school_model->get_file($id);
		$data['files'] = $query;
		$this->load->helper(array('form','url'));
		$data['title'] = " - 修改歷史列";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font>', '</font>');
		$this->form_validation->set_rules('title', '歷史文章主題', 'callback_empty_check');
		$this->form_validation->set_rules('year', '年', 'callback_empty_check');
		$this->form_validation->set_rules('month', '月', 'callback_empty_check');
		$this->form_validation->set_rules('day', '日', 'callback_empty_check');
		$this->form_validation->set_rules('content', '歷史文章內容', 'callback_empty_check');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->library('form_validation');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/history_update',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/history_update1',$data);
		}
	}

	public function history_delete($id){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_history_single($id);
		if($query->num_rows()==0){
			show_404();
		}
		$data['history'] = $query->row();
		$this->load->helper(array('form','url'));
		$data['title'] = " - 刪除歷史列";
		$this->load->view('admin/history_delete',$data);
	}

	public function file_upload($id){
		$this->load->library('form_validation');
		$this->load->helper(array('form','url'));
		$this->form_validation->set_rules('userfile', 'userfile', 'callback_empty_check');
		$data['hid'] = $id;
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'zip|doc|docx|rar|pdf|ppt|pptx';
		//$config['encrypt_name'] = TRUE;
		$config['max_size']	= '10240';
		$config['remove_spaces'] = TRUE;
		$config['max_filename'] = 0;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($_FILES['userfile']['name']==""){
			$data['msg'] = "File Empty!";
		} else if( ! $this->upload->do_upload()){
			$data['msg'] = $this->upload->display_errors();
		}else{
			$data['msg'] = "Upload success!";
			$data['upload_data'] = $this->upload->data();	
		}
		$this->load->view('admin/file_upload',$data);
	}

	public function file_delete($id){
		$this->load->helper(array('form','url','file'));
		$data['id'] = $id;
		$data['files'] = $this->merge_school_model->get_file_single($id)->row();
		$data['hid'] = $this->merge_school_model->get_file_hid($id);
		$this->load->view('admin/file_delete',$data);
	}

	public function survey(){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper(array('form','url'));
		$data['title'] = " - 管理意調";
		$data['survey'] = $this->merge_school_model->get_survey();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu_admin');
		$this->load->view('admin/survey',$data);
		$this->load->view('templates/footer');		
	}

	public function survey_insert(){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper(array('form','url'));
		$data['title'] = " - 新增意調";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font>', '</font>');
		$this->form_validation->set_rules('title', '意調主題', 'callback_empty_check');
		$this->form_validation->set_rules('y1', 'y1', 'callback_empty_check');
		$this->form_validation->set_rules('m1', 'm1', 'callback_empty_check');
		$this->form_validation->set_rules('d1', 'd1', 'callback_empty_check');
		$this->form_validation->set_rules('h1', 'h1', 'callback_empty_check');
		$this->form_validation->set_rules('i1', 'i1', 'callback_empty_check');
		$this->form_validation->set_rules('s1', 's1', 'callback_empty_check');
		$this->form_validation->set_rules('y2', 'y2', 'callback_empty_check');
		$this->form_validation->set_rules('m2', 'm2', 'callback_empty_check');
		$this->form_validation->set_rules('d2', 'd2', 'callback_empty_check');
		$this->form_validation->set_rules('h2', 'h2', 'callback_empty_check');
		$this->form_validation->set_rules('i2', 'i2', 'callback_empty_check');
		$this->form_validation->set_rules('s2', 's2', 'callback_empty_check');
		$this->form_validation->set_rules('content', '意調內容', 'callback_empty_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->library('form_validation');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/survey_insert',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/survey_insert1',$data);
		}	
	}

	public function survey_update($id){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_survey_single($id);
		if($query->num_rows()==0){
			show_404();
		}
		$data['title'] = " - 修改意調";
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$data['survey'] = $query->row();
		$this->form_validation->set_error_delimiters('<font>', '</font>');
		$this->form_validation->set_rules('title', '意調主題', 'callback_empty_check');
		$this->form_validation->set_rules('y1', 'y1', 'callback_empty_check');
		$this->form_validation->set_rules('m1', 'm1', 'callback_empty_check');
		$this->form_validation->set_rules('d1', 'd1', 'callback_empty_check');
		$this->form_validation->set_rules('h1', 'h1', 'callback_empty_check');
		$this->form_validation->set_rules('i1', 'i1', 'callback_empty_check');
		$this->form_validation->set_rules('s1', 's1', 'callback_empty_check');
		$this->form_validation->set_rules('y2', 'y2', 'callback_empty_check');
		$this->form_validation->set_rules('m2', 'm2', 'callback_empty_check');
		$this->form_validation->set_rules('d2', 'd2', 'callback_empty_check');
		$this->form_validation->set_rules('h2', 'h2', 'callback_empty_check');
		$this->form_validation->set_rules('i2', 'i2', 'callback_empty_check');
		$this->form_validation->set_rules('s2', 's2', 'callback_empty_check');
		$this->form_validation->set_rules('content', '意調內容', 'callback_empty_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->library('form_validation');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/survey_update',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/survey_update1',$data);
		}	
	}

	public function survey_delete($id){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_survey_single($id);
		if($query->num_rows()==0){
			show_404();
		}
		$data['survey'] = $query->row();
		$this->load->helper(array('form','url'));
		$data['title'] = " - 刪除歷史列";
		$this->load->view('admin/survey_delete',$data);
	}

	public function feedback($id=""){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_feedback_single($id);
		if($query->num_rows()==0 && $id!=""){
			show_404();	
		}
		if($id==""){
			$data['feedback'] = $this->merge_school_model->get_feedback();
			$data['title'] = " - 管理意見反映";
			$this->load->helper(array('form','url'));
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/feedback',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->helper(array('form','url'));
			$data['title'] = " - 管理意見反映";
			$this->load->library('form_validation');
			$this->form_validation->set_rules('status', '狀態', 'callback_empty_check');
			$data['feedback'] = $query->row();
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu_admin');
				$this->load->view('admin/feedback_single',$data);
				$this->load->view('templates/footer');
			}else{
				$this->load->view('admin/feedback_update',$data);
			}
		}
	}

	public function public_hearing($str=""){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper(array('form','url'));
		$data['title'] = " - 管理公聽會";
		$data['public_hearing'] = $this->merge_school_model->get_public_hearing();
		$data['apply'] = $this->merge_school_model->get_apply();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu_admin');
		$this->load->view('admin/public_hearing',$data);
		$this->load->view('templates/footer');		
	}

	public function public_hearing_insert($id=""){
		if($id!="" || empty($_SESSION['account'])){
			show_404();
		}
		$this->load->helper(array('form','url'));
		$data['title'] = " - 新增公聽會";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font>', '</font>');
		$this->form_validation->set_rules('title', '公聽會文章主題', 'callback_empty_check');
		$this->form_validation->set_rules('content', '公聽會文章內容', 'callback_empty_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->library('form_validation');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/public_hearing_insert');
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/public_hearing_insert1');
		}
	}

	public function public_hearing_update($id){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_public_hearing_single($id);
		if($query->num_rows()==0){
			show_404();
		}
		$data['public_hearing'] = $query->row();
		$this->load->helper(array('form','url'));
		$data['title'] = " - 修改公聽會";
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font>', '</font>');
		$this->form_validation->set_rules('title', '公聽會文章主題', 'callback_empty_check');
		$this->form_validation->set_rules('content', '公聽會文章內容', 'callback_empty_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->library('form_validation');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/public_hearing_update',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/public_hearing_update1',$data);
		}
	}

	public function public_hearing_delete($id){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_public_hearing_single($id);
		if($query->num_rows()==0){
			show_404();
		}
		$data['public_hearing'] = $query->row();
		$this->load->helper(array('form','url'));
		$data['title'] = " - 刪除公聽會";
		$this->load->view('admin/public_hearing_delete',$data);
	}

	public function discuss(){
		if(empty($_SESSION['account'])){
			show_404();
		}
		$query = $this->merge_school_model->get_discuss_all();
		$data['discuss'] = $query;
		$data['title'] = " - 討論區";
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('show', 'show', 'callback_empty_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu_admin');
			$this->load->view('admin/discuss',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('admin/discuss_update',$data);
		}
	}

	public function empty_check($str){
		if($str==""){
			$this->form_validation->set_message('empty_check','%s欄位不能為空');
			return false;
		}else{
			return TRUE;	
		}
	}

	public function account_check(){
		$account = $this->input->post('account');
		$password = $this->input->post('password');
		$check = $this->sa_model->check_account($account,$password);
		if($check){
			return TRUE;
		}else{
			$this->form_validation->set_message('account_check','帳號密碼輸入錯誤');
			return FALSE;
		}
	}

	public function code_check(){
		$code = $this->input->post('code');
		$code = md5(strtolower($code));
		if($code==$_SESSION['code']){
			return TRUE;
		}else{
			$this->form_validation->set_message('code_check','驗證碼輸入錯誤');
			return FALSE;
		}
	}
}
