<table border="1" style="margin:0 auto;">
	<tr>
		<td>新增日期</td>
		<td>姓名</td>
		<td>學號</td>
		<td>狀態</td>
		<td>管理</td>
	</tr>
	<?php foreach($feedback->result() as $row):?>
	<tr>
		<td><?=$row->adddate;?></td>
		<td><?=$row->name;?></td>
		<td><?=$row->sid;?></td>
		<td>
			<?php
				if($row->status==1){
					echo "未解決";
				}else if($row->status==2){
					echo "已解決";
				}

			?>
		</td>
		<?php
			$id = $row->id;
			$url = 'admin/feedback/'.$id;
		?>
		<td><a href="<?=base_url($url)?>">讀取</a></td>
	</tr>
	<?php endforeach?>
</table>