<meta charset="UTF-8" />
<?php
	$id = $history->id;
	$title = $this->input->post('title');
	$year = $this->input->post('year');
	$month = $this->input->post('month');
	$day = $this->input->post('day');
	$content = $this->input->post('content');
	$this->merge_school_model->history_update($id,$title,$year,$month,$day,$content);
	echo "<script>alert('修改成功');</script>";
	redirect('admin/history', 'refresh', 301);
?>