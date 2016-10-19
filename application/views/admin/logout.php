<meta charset="UTF-8" />
<?php
	$_SESSION['account'] = "";
	unset($_SESSION["account"]);
	echo "<script>alert('登出成功');</script>";
	redirect('admin', 'refresh', 301);
?>