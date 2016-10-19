<meta charset="UTF-8" />
<?php
	$title = $this->input->post('title');
	$content = $this->input->post('content');
	$sid = $this->input->post('sid');
	if(empty($_SESSION["account"])){
		$name = $studentdata->name;
	}else{
		$name = $this->input->post('name');
	}
	$top = 0;
	$show = 1;

	$this->merge_school_model->discuss_insert($title,$sid,$name,$content,$top,$show);
	echo "<script>alert('發表成功');</script>";
	redirect('discuss', 'refresh', 301);
?>