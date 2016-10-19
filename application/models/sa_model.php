<?php
class Sa_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->sa = $this->load->database('sa',TRUE);
	}

	public function get_master()
	{
		$query = $this->sa->get('master');
		return $query->result();
	}

	public function get_master_id($id){
		$id = $this->sa->escape_str($this->security->xss_clean($id));
		$query = $this->sa->query("select * from `master` where id='$id'");
		return $query;
		//return $query->result();
	}

	public function get_master_id_md5($id){
		$id = $this->sa->escape_str($this->security->xss_clean($id));
		$query = $this->sa->query("select * from `master` where md5(id)='$id'");
		return $query;
		//return $query->result();
	}

	public function check_account($account,$password){
		$account = $this->sa->escape_str($this->security->xss_clean($account));
		$password = $this->sa->escape_str($this->security->xss_clean($password));
		$password = md5($password);
		$query = $this->sa->query("select * from `master` where id='$account' and pass='$password' and level>=255 and display>=0 and display<3");
		return $query->num_rows();
	}

}