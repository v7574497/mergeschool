<?php
	date_default_timezone_set("Asia/Taipei");
	$y = date("Y");
	$m = date("m");
	$d = date("d");
	$h = date("H");
	$i = date("i");
	$s = date("s");
	$nows = mktime($h,$i,$s,$m,$d,$y);
?>
<table style="margin:0 auto">
	<?php foreach($survey->result() as $row):?>
		<?php if($row->id==4){?>
		<tr>
			<td>投票時間：<?=$row->startdate."~".$row->enddate;?></td>
			<?php
				$id = $row->id;
				$url = base_url('survey/single/'.$id);
			?>
		</tr>
		<tr>
			<td><?php echo $row->content;?></td>
		</tr>
		<?php }?>
	<?php endforeach?>
</table>

<div class="survey">
	<div class="survey-option">
		<div class="survey-option-1" onclick="location.href='<?=$url."/1"?>'"></div>
		<div class="survey-option-2" onclick="location.href='<?=$url."/2"?>'"></div>
	</div>
</div>