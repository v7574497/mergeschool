<meta charset="UTF-8" />
<?php
	$url = "uploads/".$files->url;
	$url = iconv("UTF-8", "big5",$url);
	unlink($url);
	$this->merge_school_model->file_delete_single($files->id);
	echo "<script>alert('刪除成功');</script>";
	redirect('admin/history_update/'.$hid, 'refresh', 301);
?>