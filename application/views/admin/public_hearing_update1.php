<meta charset="UTF-8" />
<?php
	$id = $public_hearing->id;
	$title = $this->input->post('title');
	$content = $this->input->post('content');
	$this->merge_school_model->public_hearing_update($id,$title,$content);
	echo "<script>alert('修改成功');</script>";
	redirect('admin/public_hearing_update/'.$id, 'refresh', 301);
?>