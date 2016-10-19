<?php echo form_open('admin/history_insert') ?>
	<table style="margin:0 auto">
		<tr>
			<td>
				歷史文章主題：
				<input type="text" name="title" value="<?php echo set_value('title');?>">
				<?=form_error('title');?>
			</td>
		</tr>
		<tr>
			<td>
				歷史文章時間：民國
				<input type="text" name="year" size="2" value="<?php echo set_value('year');?>">年
				<input type="text" name="month" size="2" value="<?php echo set_value('month');?>">月
				<input type="text" name="day" size="2" value="<?php echo set_value('day');?>">日
				<?=form_error('year');?>
				<?=form_error('month');?>
				<?=form_error('day');?>
			</td>
		</tr>
		<tr>
			<td>
				歷史文章內容：
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