<meta charset="UTF-8" />
<?php
	$id = $feedback->id;
	$status = $this->input->post('status');
	$this->merge_school_model->feedback_update($id,$status);
	echo "<script>alert('修改成功');</script>";	

	redirect('admin/feedback/'.$id, 'refresh', 301);
?>
