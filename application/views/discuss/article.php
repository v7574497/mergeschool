<?php
	$url = base_url('discuss/reply') . "/" . $article->id;
?>

<table style="margin:0 auto" width="700">
	<tr>
		<td colspan="3" align="right">
			<a href="<?=$url;?>"><button>我要回覆</button></a>
		</td>
	</tr>
</table>

<table class="mytable1">
    <thead>
        <tr>
            <th width="400">主題</th>
            <th width="100">姓名</th>
            <th width="200">新增日期</th>
        </tr>
    </thead>
    <tbody>
		<?php
			$title = $this->merge_school_model->chage_str($article->title);
			$content = $this->merge_school_model->chage_str($article->content);
		?>
		<tr>
			<td width="400"><?=$title;?></td>
			<td width="100"><?=$article->name;?></td>
			<td width="200"><?=$article->adddate;?></td>
		</tr>
		<tr>
			<td colspan="3" style="text-align:left;"><pre><?=$content;?></pre></td>
		</tr>
    </tbody>
</table>
<BR>

<?php foreach ($reply as $row): ?>
	<?php
		$content = $this->merge_school_model->chage_str($row->content);
	?>
	<table class="mytable1">
	    <thead>
	        <tr>
	            <th width="400">姓名</th>
	            <th width="300">回覆日期</th>
	        </tr>
	    </thead>
	    <tbody>
			<tr>
				<td width="400"><?php echo $row->name;?></td>
				<td width="300"><?php echo $row->adddate;?></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:left;width:700px"><pre><?=$content;?></pre></td>
			</tr>
	    </tbody>
	</table><BR>
<?php endforeach ?>