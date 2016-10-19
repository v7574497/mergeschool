<meta charset="UTF-8" />
<?php
	$id = $survey->id;
	$this->merge_school_model->survey_delete($id);
	echo "<script>alert('刪除成功');</script>";
	redirect('admin/survey', 'refresh', 301);
?>
