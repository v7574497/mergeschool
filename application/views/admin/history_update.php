<?php echo form_open('admin/history_update/'.$history->id) ?>

<?php
	$title = set_value('title');
	$year = set_value('year');
	$month = set_value('month');
	$day = set_value('day');
	$content = set_value('content');
	if(empty($title)){
		$title = $history->title;
	}
	if(empty($year)){
		$year = $history->year-1911;
	}
	if(empty($month)){
		$month = $history->month;
	}
	if(empty($day)){
		$day = $history->day;
	}
	if(empty($content)){
		$content = $history->content;
	}
?>
	<table style="margin:0 auto;">
		<tr>
			<td>
				歷史文章主題：
				<input type="text" name="title" value="<?=$title;?>">
				<?=form_error('title');?>
			</td>
		</tr>
		<tr>
			<td>
				歷史文章時間：民國
				<input type="text" name="year" size="2" value="<?=$year;?>">年
				<input type="text" name="month" size="2" value="<?=$month;?>">月
				<input type="text" name="day" size="2" value="<?=$day;?>">日
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
						$CKEditor->basePath = '../../hts/';
						//$value = html_entity_decode(set_value('content'));
						$CKEditor->editor("content",$content,"");
					?>
				</div>
				<?=form_error('content');?>
			</td>
		</tr>
		<tr>
			<td align="center"><input type="submit" value="修改"></td>
		</tr>
	</table>
</form>

<?php echo form_open_multipart('admin/file_upload/'.$history->id) ?>
<BR><table style="margin:0 auto">
	<tr>
		<td>
			<input type="file" name="userfile" size="20" />
		</td>
		<td>	
			<input type="submit" value="上傳">
		</td>
	</tr>
	<tr>
		<td align="center"><BR></td>
	</tr>
</table>
</form>

<table style="margin:0 auto" border="1">
<?php foreach($files->result() as $row):?>
<?php
	$id = $row->id;
?>
	<tr>
		<td><?=$row->url;?></td>
		<td>
			<a style="color:#f00;" href="javascript:void(0);" onclick="deletes(<?=$id;?>);">刪除</a></td>
		</td>
	</tr>
<?php endforeach?>
</table><BR>

<script type="text/javascript">
    var url="<?php echo base_url();?>";
	var delete_url = url+"admin/file_delete/";
    function deletes(id){
       var r=confirm("刪除否?");
        if (r==true){
          window.location = delete_url+id;
        }
        else{
          return false;
        }
    }
</script>