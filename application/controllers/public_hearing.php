<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_hearing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("merge_school_model");
		$this->load->model("studentmdata_model");
		$this->data['now_pages'] = "public_hearing";
		session_start();
	}
	
	public function index(){
		$this->load->helper('url');
		$this->data["title"] = " - 全校性師生座談會";
		$this->data['public_hearing'] = $this->merge_school_model->get_public_hearing();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/menu');
		$this->load->view('public_hearing/index',$this->data);
		$this->load->view('templates/footer');
	}
	
	public function apply(){
		show_404();
		$this->data['title'] = " - 全校性師生座談會 - 我要報名";
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font class="form_errors">', '</font>');
		$this->form_validation->set_rules('name', '姓名', 'callback_empty_check');
		$this->form_validation->set_rules('sid', '學號', 'callback_empty_check||callback_sid_check');
		$this->form_validation->set_rules('tid', '身分證後六碼', 'callback_empty_check|callback_tid_sid_check');
		$this->form_validation->set_rules('code', '驗證碼', 'callback_empty_check|callback_code_check');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/menu');
			$this->load->view('public_hearing/apply',$this->data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('public_hearing/apply_insert',$this->data);
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

	public function tid_sid_check(){
		$tid = $this->input->post('tid');
		$sid = $this->input->post('sid');
		$check = $this->studentmdata_model->check_tid_sid($tid,$sid);
		if($check){
			return TRUE;
		}else{
			$this->form_validation->set_message('tid_sid_check','身分證字號錯誤');
			return FALSE;
		}
	}

}
