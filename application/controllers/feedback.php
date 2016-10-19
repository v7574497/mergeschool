<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('merge_school_model');
		$this->load->model('studentmdata_model');
		$this->data['now_pages'] = "feedback";
		session_start();
	}

	public function index($id="")
	{
		if($id!=""){
			show_404();
		}
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font class="form_errors">', '</font>');
		$this->form_validation->set_rules('department', '系別', '');
		$this->form_validation->set_rules('grade', '年級', '');
		$this->form_validation->set_rules('name', '姓名', 'callback_empty_check');
		$this->form_validation->set_rules('sid', '學號', 'callback_empty_check|callback_sid_check');
		$this->form_validation->set_rules('phone', '電話', 'callback_empty_check');
		$this->form_validation->set_rules('email', '電子郵件地址', 'callback_empty_check');
		$this->form_validation->set_rules('content', '反映內容', 'callback_empty_check');
		$this->form_validation->set_rules('code', '驗證碼', 'callback_empty_check|callback_code_check');
		$this->data['title'] = " - 意見反映區";
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/menu');
			$this->load->view('feedback/index', $this->data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('feedback/insert');
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

	public function sid_check(){
		$sid = $this->input->post('sid');
		$check = $this->studentmdata_model->check_sid($sid);
		if($check){
			return TRUE;
		}else{
			$this->form_validation->set_message('sid_check','查無此學號，需為本校日間部在校生同學');
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
