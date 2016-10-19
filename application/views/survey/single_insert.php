<meta charset="UTF-8" />
<?php
	$sid = $this->input->post('sid');
	$suid = $survey->id;
	$did = $this->input->post('myradio');
	
	if($this->merge_school_model->survey_data_check($sid,$suid)){
		echo "<script>alert('您已經投過票囉~');</script>";	
	}else{
		$this->merge_school_model->survey_data_insert($sid,$suid,$did,$option);
		echo "<script>alert('投票成功');</script>";
	}
	redirect('survey', 'refresh', 301);
?>