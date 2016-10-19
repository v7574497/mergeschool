<meta charset="UTF-8" />
<?php
	$content = $this->input->post('content');
	$sid = $this->input->post('sid');
	$did = $this->input->post('did');
	if(empty($_SESSION["account"])){
		$name = $studentdata->name;
	}else{
		$name = $this->input->post('name');
	}

	$this->merge_school_model->reply_insert($did,$sid,$name,$content);
	$this->merge_school_model->discuss_show_update('2',$did);
	$this->merge_school_model->discuss_show_update('1',$did);
	echo "<script>alert('回覆成功');</script>";
	redirect('discuss/article/'.$did, 'refresh', 301);
?>