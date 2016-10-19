<?php echo form_open('admin/survey_update/'.$survey->id) ?>
<?php
	date_default_timezone_set("Asia/Taipei");
	$title = set_value('title');
	$y1 = set_value('y1');
	$m1 = set_value('m1');
	$d1 = set_value('d1');
	$h1 = set_value('h1');
	$i1 = set_value('i1');
	$s1 = set_value('s1');
	$y2 = set_value('y2');
	$m2 = set_value('m2');
	$d2 = set_value('d2');
	$h2 = set_value('h2');
	$i2 = set_value('i2');
	$s2 = set_value('s2');
	$content = set_value('content');
	if(empty($title)){
		$title = $survey->title;
	}
	if(empty($y1)){
		$y1 = date("Y",$survey->starttime);
	}
	if(empty($m1)){
		$m1 = date("m",$survey->starttime);
	}
	if(empty($d1)){
		$d1 = date("d",$survey->starttime);
	}
	if(empty($h1)){
		$h1 = date("H",$survey->starttime);
	}
	if(empty($i1)){
		$i1 = date("i",$survey->starttime);
	}
	if(empty($s1)){
		$s1 = date("s",$survey->starttime);
	}
	if(empty($y2)){
		$y2 = date("Y",$survey->endtime);
	}
	if(empty($m2)){
		$m2 = date("m",$survey->endtime);
	}
	if(empty($d2)){
		$d2 = date("d",$survey->endtime);
	}
	if(empty($h2)){
		$h2 = date("H",$survey->endtime);
	}
	if(empty($i2)){
		$i2 = date("i",$survey->endtime);
	}
	if(empty($s2)){
		$s2 = date("s",$survey->endtime);
	}
	if(empty($content)){
		$content = $survey->content;
	}
?>
	<table style="margin:0 auto">
		<tr>
			<td>
				意調主題：
				<input type="text" name="title" value="<?=$title;?>">
				<?=form_error('title');?>
			</td>
		</tr>
		<tr>
			<td>
				意調時間：西元
				<input type="text" name="y1" size="3" value="<?=$y1;?>">年
				<input type="text" name="m1" size="1" value="<?=$m1;?>">月
				<input type="text" name="d1" size="1" value="<?=$d1;?>">日
				<input type="text" name="h1" size="1" value="<?=$h1;?>">時
				<input type="text" name="i1" size="1" value="<?=$i1;?>">分
				<input type="text" name="s1" size="1" value="<?=$s1;?>">秒
				~
				<input type="text" name="y2" size="3" value="<?=$y2;?>">年
				<input type="text" name="m2" size="1" value="<?=$m2;?>">月
				<input type="text" name="d2" size="1" value="<?=$d2;?>">日
				<input type="text" name="h2" size="1" value="<?=$h2;?>">時
				<input type="text" name="i2" size="1" value="<?=$i2;?>">分
				<input type="text" name="s2" size="1" value="<?=$s2;?>">秒
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
						$CKEditor->basePath = '../../hts/';
						//$value = html_entity_decode(set_value('content'));
						$CKEditor->editor("content",$content,"");
					?>
				</div>
				<?=form_error('content');?>
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="修改"></td>
		</tr>
	</table>
</form>