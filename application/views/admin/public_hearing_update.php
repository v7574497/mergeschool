<?php echo form_open('admin/public_hearing_update/'.$public_hearing->id) ?>
<?php
	$title = set_value('title');
	$content = set_value('content');
	if(empty($title)){
		$title = $public_hearing->title;
	}
	if(empty($content)){
		$content = $public_hearing->content;
	}
?>
	<table style="margin:0 auto;">
		<tr>
			<td>
				公聽會文章新增時間：<?=$public_hearing->adddate;?>
			</td>
		</tr>
		<tr>
			<td>
				公聽會文章主題：
				<input type="text" name="title" value="<?=$title;?>">
				<?=form_error('title');?>
			</td>
		</tr>
		<tr>
			<td>
				公聽會文章內容：

				<div style="width:500px">
					<?php
						include_once "hts/ckeditor.php";
						$CKEditor = new CKEditor();
						$CKEditor->basePath = '../../hts/';
						//$value = html_entity_decode($content);
						$CKEditor->editor("content",$content,"");
					?>
				</div>
				<?=form_error('content');?>
			</td>
		</tr>
		<tr align="center">
			<td><BR><input type="submit" value="修改"></td>
		</tr>
	</table>
</form>