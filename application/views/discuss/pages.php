<table style="margin:0 auto" width="1000">
	<tr>
		<td align="right">
			<a href="<?=base_url('discuss/publication')?>"><button>我要發表</button></a>
		</td>
	</tr>
</table>

<table class="mytable">
    <thead>
        <tr>
            <th width="600">主題</th>
            <th width="100">作者</th>
            <th width="100">回覆</th>
            <th width="200">更新日期</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th colspan="4">
			<?php
				$url = base_url('discuss/pages')."/";
				$next_url = base_url('discuss/pages')."/".($pages+1);
				$pre_url = base_url('discuss/pages')."/".($pages-1);
				if($pre){
					echo "<a href='$pre_url'><</a> ";
				}
				for($i=1;$i<=$all;$i++){
					if($i==$pages){
						echo "<a href='".$url.$i."' class='pages_now'>$i</a>";	
					}else{
						echo "<a href='".$url.$i."'>$i</a>";		
					}
				}
				if($next){
					echo " <a href='$next_url'>></a>";
				}
			?>
            </th>
        </tr>
    </tfoot>
    <tbody>
		<?php foreach ($discuss as $row): ?>
		<?php
			$url = base_url("discuss/article/" . $row->id);
			$title = $this->merge_school_model->chage_str($row->title);
			$nums = $this->merge_school_model->get_reply_nums($row->id);
		?>
		<tr onclick="location.href='<?=$url?>'">
			<td width="600"><?=$title;?></td>
			<td width="100"><?=$row->name;?></td>
			<td width="100"><?=$nums;?></td>
			<td width="200"><?=$row->updatedate;?></td>
		</tr>
		<?php endforeach ?>
    </tbody>
</table>
