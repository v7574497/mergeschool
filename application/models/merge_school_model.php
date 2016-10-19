<?php
class Merge_school_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->merge = $this->load->database('merge_school',TRUE);
	}

	public function get_discuss_all(){
		$query = "select * from `discuss` order by updatedate desc"; 
		$query = $this->merge->query($query);
		return $query->result();
	}

	public function get_discuss($pages,$much)
	{
		$query = "select * from `discuss` where `show`='1' order by updatedate desc limit ".$pages.",".$much; 
		$query = $this->merge->query($query);
		return $query->result();
	}

	public function get_article($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$query = $this->merge->query("select * from `discuss` where id = '$id' && `show` = 1");
		return $query;
	}

	public function get_reply($did){
		$did = $this->merge->escape_str($this->security->xss_clean($did));
		$query = $this->merge->query("select * from `discuss_reply` where did = '$did'");
		return $query;
	}

	public function discuss_insert($title,$sid,$name,$content,$top,$show){
		$title = $this->merge->escape_str($this->security->xss_clean($title));
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$content = $this->merge->escape_str($this->security->xss_clean($content));

		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		
		date_default_timezone_set("Asia/Taipei");
		$adddate = date("Y-m-d H:i:s");

		$data = array(
		   'title' => $title ,
		   'sid' => $sid ,
		   'name' => $name ,
		   'content' => $content ,
		   'top' => $top ,
		   'show' => $show ,
		   'adddate' => $adddate ,
		   'addip' => $addip
		);

		$this->merge->insert('discuss', $data); 
	}

	public function discuss_show_update($show,$id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$data = array(
		   'show' => $show
		);

		$this->merge->where('id', $id);
		$this->merge->update('discuss',$data);
	}

	public function discuss_updatedate($updatedate,$id){
		$data = array(
		   'updatedate' => $updatedate
		);

		$this->merge->where('id', $id);
		$this->merge->update('discuss',$data);
	}


	public function reply_insert($did,$sid,$name,$content){
		$did = $this->merge->escape_str($this->security->xss_clean($did));
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$content = $this->merge->escape_str($this->security->xss_clean($content));

		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];

		$data = array(
		   'did' => $did ,
		   'sid' => $sid ,
		   'name' => $name ,
		   'content' => $content ,
		   'addip' => $addip
		);

		$this->merge->insert('discuss_reply', $data); 
	}

	public function get_reply_nums($did){
		$did = $this->merge->escape_str($this->security->xss_clean($did));
		$query = $this->merge->query("select * from `discuss_reply` where did = '$did'");
		return $query->num_rows();
	}

	public function get_discuss_nums(){
		$query = $this->merge->query("select * from `discuss` where `show`='1'");
		return $query->num_rows();
	}

	public function chage_str($str){
		$foo = array('\r\n','\"',"\'");
		$bar = array('<BR>','"',"'");
		return str_replace($foo, $bar, $str);
	}

	public function chage_str1($str){
		$foo = array('\r\n','\"',"\'");
		$bar = array('','"',"'");
		return str_replace($foo, $bar, $str);
	}

	public function chage_textarea_str($str){
		$foo = array('\r\n');
		$bar = array(chr(10));
		return str_replace($foo, $bar, $str);
	}

	public function history_insert($title,$year,$month,$day,$content){
		$year = $this->merge->escape_str($this->security->xss_clean($year))+1911;
		$month = $this->merge->escape_str($this->security->xss_clean($month));
		$day = $this->merge->escape_str($this->security->xss_clean($day));
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('Asia/Taipei');
		$nows = mktime(0,0,0,$month,$day,$year);
		$data = array(
		   'title' => $title ,
		   'year' => $year ,
		   'month' => $month ,
		   'day' => $day ,
		   'content' => $content ,
		   'nows' => $nows ,
		   'addip' => $addip
		);
		$this->merge->insert('history', $data); 
	}

	public function get_history(){
		$query = $this->merge->query("select * from `history` order by nows desc");
		return $query;
	}

	public function get_history_single($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$query = $this->merge->query("select * from `history` where id='$id'");
		return $query;
	}

	public function history_update($id,$title,$year,$month,$day,$content){
		$year = $this->merge->escape_str($this->security->xss_clean($year))+1911;
		$month = $this->merge->escape_str($this->security->xss_clean($month));
		$day = $this->merge->escape_str($this->security->xss_clean($day));
		date_default_timezone_set('Asia/Taipei');
		$nows = mktime(0,0,0,$month,$day,$year);
		$data = array(
		   'title' => $title ,
		   'year' => $year ,
		   'month' => $month ,
		   'day' => $day ,
		   'content' => $content ,
		   'nows' => $nows
		);
		$this->merge->where('id', $id);
		$this->merge->update('history', $data); 
	}

	public function history_delete($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$this->merge->where('id', $id);
		$this->merge->delete('history'); 
	}

	public function file_insert($name,$url,$hid){
		$data = array(
		   'name' => $name ,
		   'url' => $url ,
		   'hid' => $hid
		);
		$this->merge->insert('files', $data); 
	}

	public function get_file($hid){
		$query = $this->merge->query("select * from `files` where hid='$hid'");
		return $query;
	}

	public function get_file_single($id){
		$query = $this->merge->query("select * from `files` where id='$id'");
		return $query;
	}

	public function get_file_hid($id){
		$query = $this->merge->query("select * from `files` where id='$id'");
		$row = $query->row();
		return $row->hid;
	}

	public function file_delete($hid){
		$this->merge->where('hid', $hid);
		$this->merge->delete('files'); 
	}

	public function file_delete_single($id){
		$this->merge->where('id', $id);
		$this->merge->delete('files'); 
	}

	public function survey_insert($title,$startdate,$enddate,$starttime,$endtime,$content){
		$startdate = $this->merge->escape_str($this->security->xss_clean($startdate));
		$enddate = $this->merge->escape_str($this->security->xss_clean($enddate));
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		$data = array(
		   'title' => $title ,
		   'startdate' => $startdate ,
		   'enddate' => $enddate ,
		   'starttime' => $starttime ,
		   'endtime' => $endtime ,
		   'content' => $content ,
		   'addip' => $addip ,
		   'hid' => '0'
		);
		$this->merge->insert('survey',$data);
	}

	public function survey_update($id,$title,$startdate,$enddate,$starttime,$endtime,$content){
		$startdate = $this->merge->escape_str($this->security->xss_clean($startdate));
		$enddate = $this->merge->escape_str($this->security->xss_clean($enddate));
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		$data = array(
		   'title' => $title ,
		   'startdate' => $startdate ,
		   'enddate' => $enddate ,
		   'starttime' => $starttime ,
		   'endtime' => $endtime ,
		   'content' => $content ,
		   'addip' => $addip ,
		   'hid' => '0'
		);
		$this->merge->where('id', $id);
		$this->merge->update('survey', $data); 
	}

	public function survey_delete($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$this->merge->where('id', $id);
		$this->merge->delete('survey'); 
	}

	public function get_survey(){
		$query = $this->merge->query("select * from `survey` order by id desc");
		return $query;
	}

	public function get_survey_single($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$query = $this->merge->query("select * from `survey` where id='$id'");
		return $query;
	}

	public function survey_data_insert($sid,$suid,$did,$kindid){
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$suid = $this->merge->escape_str($this->security->xss_clean($suid));
		$did = $this->merge->escape_str($this->security->xss_clean($did));
		$kindid = $this->merge->escape_str($this->security->xss_clean($kindid));
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		$data = array(
		   'sid' => $sid ,
		   'suid' => $suid ,
		   'did' => $did ,
		   'kindid' => $kindid ,
		   'addip' => $addip
		);
		$this->merge->insert('survey_data',$data);

	}

	public function get_survey_data($suid,$kindid,$did){
		$query = $this->merge->query("select * from `survey_data` where kindid='$kindid' && did='$did' && suid='$suid'");
		return $query->num_rows();
	}

	public function survey_data_check($sid,$suid){
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$suid = $this->merge->escape_str($this->security->xss_clean($suid));
		$query = $this->merge->query("select * from `survey_data` where sid='$sid' && suid='$suid'");
		return $query->num_rows();
	}

	public function feedback_insert($department,$grade,$name,$sid,$phone,$email,$content){
		$name = $this->merge->escape_str($this->security->xss_clean($name));
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$phone = $this->merge->escape_str($this->security->xss_clean($phone));
		$email = $this->merge->escape_str($this->security->xss_clean($email));
		$content = $this->merge->escape_str($this->security->xss_clean($content));
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		$data = array(
		   'department' => $department ,
		   'grade' => $grade ,
		   'name' => $name ,
		   'sid' => $sid ,
		   'phone' => $phone ,
		   'email' => $email ,
		   'content' => $content ,
		   'addip' => $addip ,
		   'status' => '1'
		);
		$this->merge->insert('feedback',$data);
	}

	public function get_feedback(){
		$query = $this->merge->query("select * from `feedback` order by id desc");
		return $query;
	}

	public function get_feedback_single($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$query = $this->merge->query("select * from `feedback` where id='$id'");
		return $query;
	}

	public function feedback_update($id,$status){
		$data = array(
		   'status' => $status
		);
		$this->merge->where('id', $id);
		$this->merge->update('feedback', $data); 
	}



	public function public_hearing_insert($title,$content){
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		$data = array(
		   'title' => $title ,
		   'content' => $content ,
		   'addip' => $addip
		);
		$this->merge->insert('public_hearing', $data); 
	}

	public function get_public_hearing(){
		$query = $this->merge->query("select * from `public_hearing` order by id desc");
		return $query;
	}

	public function get_public_hearing_single($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$query = $this->merge->query("select * from `public_hearing` where id='$id'");
		return $query;
	}

	public function public_hearing_update($id,$title,$content){
		$content = $content;
		$data = array(
		   'title' => $title ,
		   'content' => $content
		);
		$this->merge->where('id', $id);
		$this->merge->update('public_hearing', $data); 
	}

	public function public_hearing_delete($id){
		$id = $this->merge->escape_str($this->security->xss_clean($id));
		$this->merge->where('id', $id);
		$this->merge->delete('public_hearing'); 
	}

	public function apply_insert($sid,$name){
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$name = $this->merge->escape_str($this->security->xss_clean($name));
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
			$addip=$_SERVER['HTTP_CLIENT_IP'];
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$addip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$addip=$_SERVER['REMOTE_ADDR'];
		$data = array(
		   'sid' => $sid ,
		   'addip' => $addip ,
		   'name' => $name
		);
		$this->merge->insert('apply', $data); 
	}

	public function get_apply(){
		$query = $this->merge->query("select * from `apply` order by id desc");
		return $query;
	}

	public function get_apply_single($sid){
		$sid = $this->merge->escape_str($this->security->xss_clean($sid));
		$query = $this->merge->query("select * from `apply` where sid='$sid'");
		return $query;
	}

}