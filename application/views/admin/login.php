<?php
?>
<?php echo form_open('admin') ?>
	<table style="margin:0 auto;">
		<tr>
			<td>
				帳號：
				<input type="text" name="account" value="<?php echo set_value('account');?>">
				<?php echo form_error('account');?>
			</td>
		</tr>
		<tr>
			<td>
				密碼：
				<input type="password" name="password" value="<?php echo set_value('password');?>">
				<?php echo form_error('password');?>
			</td>
		</tr>
		<tr>
			<td>
				驗證碼：
				<label><img src="font/code.php" onclick="javascript:this.src='font/code.php?tm='+Math.random();" style="cursor:pointer;" alt="點此刷新驗證碼"/></label> 
				<input type="text" name="code">
				<?php echo form_error('code');?>
			</td>
		</tr>
		<tr align="center">
			<td><BR><input type="submit" value="登入"></td>
		</tr>
	</table>
</form>
