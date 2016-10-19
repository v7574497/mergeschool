<meta charset="UTF-8" />
<?php
	$_SESSION['account'] = md5($this->input->post('account'));
	echo "<script>alert('登入成功');</script>";
	redirect('admin', 'refresh', 301);
?>