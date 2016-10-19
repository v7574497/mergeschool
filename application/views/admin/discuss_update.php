<meta charset="UTF-8" />
<?php
	$show = $this->input->post("show");
	$id =  $this->input->post("did");
	$updatedate =  $this->input->post("updatedate");
	$this->merge_school_model->discuss_show_update($show,$id);
	$this->merge_school_model->discuss_updatedate($updatedate,$id);
	echo "<script>alert('修改成功');</script>";
	redirect('admin/discuss', 'refresh', 301);
?>