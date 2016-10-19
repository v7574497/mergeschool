<?php
class Studentmdata_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->studentmdata = $this->load->database('studentmdata',TRUE);
	}

	public function check_sid($sid){
		$sid = $this->studentmdata->escape_str($this->security->xss_clean($sid));
		$query = $this->studentmdata->query("select * from `studentdata` where sid='$sid'");
		return $query->num_rows();
	}

	public function check_tid_sid($tid,$sid){
		$tid = $this->studentmdata->escape_str($this->security->xss_clean($tid));
		$sid = $this->studentmdata->escape_str($this->security->xss_clean($sid));
		$query = $this->studentmdata->query("select * from `studentdata` where right(tid,6)='$tid' and sid='$sid'");
		return $query->num_rows();
	}

	public function get_studentdata($sid){
		$sid = $this->studentmdata->escape_str($this->security->xss_clean($sid));
		$query = $this->studentmdata->query("select * from `studentdata` where sid='$sid'");
		return $query->row();
	}

	public function check_sid_re($sid){
		$sid = $this->studentmdata->escape_str($this->security->xss_clean($sid));
		$query = $this->studentmdata->query("select * from `studentdata_re` where sid='$sid'");
		return $query->num_rows();
	}

	public function check_tid_sid_re($tid,$sid){
		$tid = $this->studentmdata->escape_str($this->security->xss_clean($tid));
		$sid = $this->studentmdata->escape_str($this->security->xss_clean($sid));
		$query = $this->studentmdata->query("select * from `studentdata_re` where right(tid,6)='$tid' and sid='$sid'");
		return $query->num_rows();
	}

	public function get_studentdata_re($sid){
		$sid = $this->studentmdata->escape_str($this->security->xss_clean($sid));
		$query = $this->studentmdata->query("select * from `studentdata_re` where sid='$sid'");
		return $query->row();
	}
}