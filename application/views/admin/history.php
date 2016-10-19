<table border="1" style="margin:0 auto;">
<tr><td>
<a href="<?=base_url('admin/history_insert')?>">新增歷史列</a>
</td></tr>
</table>
<table border="1" style="margin:0 auto;">
  <tr>
    <td>主題</td>
    <td>民國年</td>
    <td>月</td>
    <td>日</td>
    <td colspan="2">管理</td>
  </tr>
	<?php foreach($history->result() as $row):?>
	<tr>
		<td><?=$row->title;?></td>
		<td><?=$row->year-1911;?></td>
		<td><?=$row->month;?></td>
		<td><?=$row->day;?></td>
		<?php
			$id = $row->id;
		?>
		<td><a href="javascript:void(0);" onclick="updates(<?=$id;?>);">修改</a></td>
		<td><a href="javascript:void(0);" onclick="deletes(<?=$id;?>);">刪除</a></td>
	</tr>
	<?php endforeach?>
</table>

<script type="text/javascript">
    var url="<?php echo base_url();?>";
  var update_url = url+"admin/history_update/";
  var delete_url = url+"admin/history_delete/";
    function updates(id){
        window.location = update_url+id;
    }
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
