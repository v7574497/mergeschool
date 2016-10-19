<meta charset="UTF-8" />
<?php
	if($msg=="File Empty!"){
		echo "<script>alert('上傳檔案為空');</script>";
	}else if($msg=="Upload success!"){
		$url = iconv('big5', 'UTF-8', $upload_data['file_name']);
		$file_name= iconv('big5', 'UTF-8', $upload_data['raw_name']);
		$this->merge_school_model->file_insert($file_name,$url,$hid);
		//echo $url . "<BR>";
		//echo $file_name . "<BR>";
		echo "<script>alert('上傳成功');</script>";
	}else{
		echo $msg;
		echo "<script>alert('上傳失敗');</script>";
	}
	redirect('admin/history_update/'.$hid, 'refresh', 301);
?>

<?php foreach ($upload_data as $item => $value):?>

<?php
	$value = iconv('big5', 'UTF-8', $value);
?> 
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>