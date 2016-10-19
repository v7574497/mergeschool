<meta charset="UTF-8" />
<?php
	$department = $this->input->post('department');
	$grade = $this->input->post('grade');
	$name = $this->input->post('name');
	$sid = $this->input->post('sid');
	$phone = $this->input->post('phone');
	$email = $this->input->post('email');
	$content = $this->input->post('content');
	$this->merge_school_model->feedback_insert($department,$grade,$name,$sid,$phone,$email,$content);
	echo "<script>alert('感謝您的反映!!');</script>";
	redirect('discuss','refresh', 301);
?>