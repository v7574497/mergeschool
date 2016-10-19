<meta charset="UTF-8" />
<?php
	$id = $public_hearing->id;
	$this->merge_school_model->public_hearing_delete($id);
	echo "<script>alert('刪除成功');</script>";
	redirect('admin/public_hearing', 'refresh', 301);
?>
