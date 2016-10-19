<?php echo form_open('admin/public_hearing_insert') ?>
	<table style="margin:0 auto;">
		<tr>
			<td>
				公聽會文章主題：
				<input type="text" name="title" value="<?php echo set_value('title');?>">
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
						$CKEditor->basePath = '../hts/';
						//$value = html_entity_decode(set_value('content'));
						$CKEditor->editor("content",set_value('content'),"");
					?>
				</div>
				<?=form_error('content');?>
			</td>
		</tr>
		<tr>
			<td align="center"><BR><input type="submit" value="新增"></td>
		</tr>
	</table>
</form>
