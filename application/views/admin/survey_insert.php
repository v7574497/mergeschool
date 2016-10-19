<?php echo form_open('admin/survey_insert') ?>
	<table style="margin:0 auto;">
		<tr>
			<td>
				意調主題：
				<input type="text" name="title" value="<?php echo set_value('title');?>">
				<?=form_error('title');?>
			</td>
		</tr>
		<tr>
			<td>
				意調時間：西元
				<input type="text" name="y1" size="3" value="<?php echo set_value('y1');?>">年
				<input type="text" name="m1" size="1" value="<?php echo set_value('m1');?>">月
				<input type="text" name="d1" size="1" value="<?php echo set_value('d1');?>">日
				<input type="text" name="h1" size="1" value="<?php echo set_value('h1');?>">時
				<input type="text" name="i1" size="1" value="<?php echo set_value('i1');?>">分
				<input type="text" name="s1" size="1" value="<?php echo set_value('s1');?>">秒
				~
				<input type="text" name="y2" size="3" value="<?php echo set_value('y2');?>">年
				<input type="text" name="m2" size="1" value="<?php echo set_value('m2');?>">月
				<input type="text" name="d2" size="1" value="<?php echo set_value('d2');?>">日
				<input type="text" name="h2" size="1" value="<?php echo set_value('h2');?>">時
				<input type="text" name="i2" size="1" value="<?php echo set_value('i2');?>">分
				<input type="text" name="s2" size="1" value="<?php echo set_value('s2');?>">秒
				<?=form_error('y1');?>
				<?=form_error('m1');?>
				<?=form_error('d1');?>
				<?=form_error('h1');?>
				<?=form_error('i1');?>
				<?=form_error('s1');?>
				<?=form_error('y2');?>
				<?=form_error('m2');?>
				<?=form_error('d2');?>
				<?=form_error('h2');?>
				<?=form_error('i2');?>
				<?=form_error('s2');?>
			</td>
		</tr>
		<tr>
			<td>
				意調內容：
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