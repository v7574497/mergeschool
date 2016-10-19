<meta charset="UTF-8" />
<?php
	$id = $history->id;
	$query = $this->merge_school_model->get_file($id);
	foreach($query->result() as $row):
		$url = "uploads/".$row->url;
		$url = iconv("UTF-8", "big5",$url);
		unlink($url);
		$this->merge_school_model->file_delete_single($row->id);
	endforeach;
	$this->merge_school_model->history_delete($id);
	echo "<script>alert('刪除成功');</script>";
	redirect('admin/history', 'refresh', 301);
?>
