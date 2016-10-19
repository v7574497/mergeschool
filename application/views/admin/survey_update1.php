<meta charset="UTF-8" />
<?php
	$id = $survey->id;
	$title = $this->input->post('title');
	$y1 = $this->input->post('y1');
	$m1 = $this->input->post('m1');
	$d1 = $this->input->post('d1');
	$h1 = $this->input->post('h1');
	$i1 = $this->input->post('i1');
	$s1 = $this->input->post('s1');
	$y2 = $this->input->post('y2');
	$m2 = $this->input->post('m2');
	$d2 = $this->input->post('d2');
	$h2 = $this->input->post('h2');
	$i2 = $this->input->post('i2');
	$s2 = $this->input->post('s2');
	date_default_timezone_set("Asia/Taipei");
	$content = $this->input->post('content');
	$startdate = sprintf("%02d-%02d-%02d %02d:%02d:%02d",$y1,$m1,$d1,$h1,$i1,$s1);
	$enddate = sprintf("%02d-%02d-%02d %02d:%02d:%02d",$y2,$m2,$d2,$h2,$i2,$s2);
	$starttime = mktime($h1,$i1,$s1,$m1,$d1,$y1);
	$endtime = mktime($h2,$i2,$s2,$m2,$d2,$y2);

	$this->merge_school_model->survey_update($id,$title,$startdate,$enddate,$starttime,$endtime,$content);
	echo "<script>alert('修改成功');</script>";
	redirect('admin/survey_update/'.$id,'refresh', 301);
?>