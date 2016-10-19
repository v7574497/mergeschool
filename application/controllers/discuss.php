<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discuss extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('merge_school_model');
		$this->load->model('studentmdata_model');
		$this->load->model('sa_model');
		$this->data['now_pages'] = "discuss";
	}
	
	public function pages($id=""){
		if($id==""){
			show_404();
		}
		$much = 10;
		$nums = $this->merge_school_model->get_discuss_nums();
		if(($id-1)*$much>=$nums && $id!=1){
			show_404();
		}
		$this->data['next'] = 1;
		$this->data['pre'] = 1;
		if($id*$much>=$nums){
			$this->data['next'] = 0;
		}
		if(($id-1)*$much<=0){
			$this->data['pre'] = 0;
		}
		$now = ($id-1)*$much;
		$this->data['discuss'] = $this->merge_school_model->get_discuss($now,$much);
		$this->load->helper('url');
		$this->data['pages'] = $id;
		$this->data['title'] = " - 三校合併討論區";
		$all = 0;
		while($nums>0){
			$all++;
			$nums-=$much;
		}
		$this->data['all'] = $all;
		$this->load->view('templates/header', $this->data);
		$this->load->view('templates/menu');
		$this->load->view('discuss/pages', $this->data);
		$this->load->view('templates/footer');

	}

	public function publication($id=""){
		if($id!=""){
			show_404();
		}
		session_start();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->data['title'] = " - 三校合併討論區 - 我要發表";
		$this->form_validation->set_error_delimiters('<font class="form_errors">', '</font>');
		$this->form_validation->set_rules('title', '主題', 'callback_empty_check');
		$this->form_validation->set_rules('content', '內容', 'callback_empty_check');
		if(empty($_SESSION["account"])){
			$this->form_validation->set_rules('sid', '學號', 'callback_empty_check||callback_sid_check');
			$this->form_validation->set_rules('tid', '身分證後六碼', 'callback_empty_check|callback_tid_sid_check');
		}
		$this->form_validation->set_rules('code', '驗證碼', 'callback_empty_check|callback_code_check');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/menu');
			$this->load->view('discuss/publication');
			$this->load->view('templates/footer');
		}else{
			if(empty($_SESSION["account"])){
				$sid = $this->input->post('sid');
				$this->data['studentdata'] = $this->studentmdata_model->get_studentdata($sid);
			}
			$this->load->view('discuss/publication_insert',$this->data);
		}
	}

	public function article($id=""){
		if($id==""){
			show_404();
		}
		$query = $this->merge_school_model->get_article($id);
		if($query->num_rows()==0){
			show_404();
		}
		$did = $id;
		$this->load->helper('url');
		$this->data['article'] = $query->row();
		$this->data['title'] = " - ".$this->data['article']->title;
		$query = $this->merge_school_model->get_reply($did);
		$this->data['reply'] = $query->result();
		$this->load->view('templates/header', $this->data);
		$this->load->view('templates/menu');
		$this->load->view('discuss/article',$this->data);
		$this->load->view('templates/footer');
	}

	public function reply($id=""){
		if($id==""){
			show_404();
		}
		$query = $this->merge_school_model->get_article($id);
		if($query->num_rows()==0){
			show_404();
		}
		session_start();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<font class="form_errors">', '</font>');

		$this->form_validation->set_rules('content', '內容', 'callback_empty_check');
		if(empty($_SESSION["account"])){
			$this->form_validation->set_rules('sid', '學號', 'callback_empty_check||callback_sid_check');
			$this->form_validation->set_rules('tid', '身分證後六碼', 'callback_empty_check|callback_tid_sid_check');
		}
		$this->form_validation->set_rules('code', '驗證碼', 'callback_empty_check|callback_code_check');

		if ($this->form_validation->run() == FALSE){
			$this->data['article'] = $query->row();
			$this->data['title'] = " - 三校合併討論區 - 回覆:".$this->data['article']->title;
			$this->load->view('templates/header', $this->data);
			$this->load->view('templates/menu');
			$this->load->view('discuss/reply',$this->data);
			$this->load->view('templates/footer');
		}else{
			if(empty($_SESSION["account"])){
				$sid = $this->input->post('sid');
				$this->data['studentdata'] = $this->studentmdata_model->get_studentdata($sid);
			}
			$this->load->view('discuss/reply_insert',$this->data);
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
