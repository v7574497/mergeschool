<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('merge_school_model');
		$this->load->model('studentmdata_model');
		$this->data['now_pages'] = "survey";
		session_start();
	}
	
	public function index(){
		$this->data['survey'] = $this->merge_school_model->get_survey();
		$this->data['title'] = " - 三校合併意願調查";
		$this->load->helper('url');
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/menu');
		$this->load->view('survey/index',$this->data);
		$this->load->view('templates/footer');
	}

	public function single($id="",$option=""){
		if(empty($id) || empty($option)){
			show_404();
		}
		if($option!="1" && $option!="2"){
			show_404();	
		}
		$query = $this->merge_school_model->get_survey_single($id);
		if($query->num_rows()==0){
			show_404();	
		}
		$row = $query->row();
		date_default_timezone_set("Asia/Taipei");
		$y = date("Y");
		$m = date("m");
		$d = date("d");
		$h = date("H");
		$i = date("i");
		$s = date("s");
		$nows = mktime($h,$i,$s,$m,$d,$y);
		$this->data['title'] = " - 三校合併意願調查";
		$this->data['survey'] = $row;
		$this->data['option'] = $option;
		$this->data['nows'] = $nows;
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<font class="form_errors">', '</font>');

		if($option=="1"){
			$this->form_validation->set_rules('sid', '學號', 'callback_empty_check|callback_sid_check');
			$this->form_validation->set_rules('tid', '身分證字號', 'callback_empty_check|callback_tid_sid_check');
		}else if($option=="2"){
			$this->form_validation->set_rules('sid', '學號', 'callback_empty_check|callback_sid_check_re');
			$this->form_validation->set_rules('tid', '身分證字號', 'callback_empty_check|callback_tid_sid_check_re');
		}
		$this->form_validation->set_rules('myradio', '投票', 'callback_empty_check');
		$this->form_validation->set_rules('code', '驗證碼', 'callback_empty_check|callback_code_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/menu');
			$this->load->view('survey/single',$this->data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('survey/single_insert',$this->data);
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


	public function sid_check_re(){
		$sid = $this->input->post('sid');
		$check = $this->studentmdata_model->check_sid_re($sid);
		if($check){
			return TRUE;
		}else{
			$this->form_validation->set_message('sid_check_re','查無此學號，需為本校研究生在校生同學');
			return FALSE;
		}
	}

	public function tid_sid_check_re(){
		$tid = $this->input->post('tid');
		$sid = $this->input->post('sid');
		$check = $this->studentmdata_model->check_tid_sid_re($tid,$sid);
		if($check){
			return TRUE;
		}else{
			$this->form_validation->set_message('tid_sid_check_re','身分證字號錯誤');
			return FALSE;
		}
	}
}
