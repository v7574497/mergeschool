<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("merge_school_model");
		$this->data['now_pages'] = "history";
	}
	
	public function index(){
		$this->load->helper('url');
		$this->data["title"] = "";
		$this->data['history'] = $this->merge_school_model->get_history();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/menu');
		$this->load->view('history/index',$this->data);
		$this->load->view('templates/footer');
	}

}
