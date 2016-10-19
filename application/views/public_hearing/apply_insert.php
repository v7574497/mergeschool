<meta charset="UTF-8" />
<?php
	$sid = $this->input->post('sid');
	$name = $this->input->post('name');
	$num = $this->merge_school_model->get_apply_single($sid)->num_rows();
	if($num){
		echo "<script>alert('您已經報名過囉~');</script>";
		redirect('public_hearing', 'refresh', 301);
	}else{
		$this->merge_school_model->apply_insert($sid,$name);
		echo "<script>alert('報名成功');</script>";
		redirect('public_hearing', 'refresh', 301);
	}
?>