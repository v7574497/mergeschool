<table border="1" style="margin:0 auto;">
<tr><td>
<a href="<?=base_url('admin/public_hearing_insert')?>">新增公聽會</a>
</td></tr>
</table>
<table border="1" style="margin:0 auto;">
  <tr>
    <td>主題</td>
    <td>新增時間</td>
    <td colspan="2">管理</td>
  </tr>
	<?php foreach($public_hearing->result() as $row):?>
	<tr>
		<td><?=$row->title;?></td>
    <td><?=$row->adddate;?></td>
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
	var update_url = url+"admin/public_hearing_update/";
	var delete_url = url+"admin/public_hearing_delete/";
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

<BR>
<table border="1" style="float:left;margin-left:200px;">
  <tr> 
      <td colspan="4" align="center">報名資料</td>
  </tr>
<?php
    $ch1 = 0;
    $ch2 = 0;
    $another = 0;
?>
<?php foreach($apply->result() as $row):?>
  <tr>
    <td><?=$row->name;?></td>
    <td><?=$row->sid;?></td>
    <td>
    <?php
      $sid = substr($row->sid,4,3);
      switch($sid){
        case "101" : echo "化材系" ;$ch1++;break;
        case "102" : echo "土木系" ;$ch1++;break;
        case "103" : echo "機械系" ;$ch1++;break;
        case "104" : echo "電機系" ;$ch1++;break;
        case "105" : echo "電子系" ;$ch1++;break;
        case "106" : echo "模具系" ;$ch1++;break;
        case "107" : echo "工管系" ;$ch1++;break;
        case "108" : echo "資工系" ;$ch1++;break;
        case "131" : echo "會計系" ;$ch2++;break;
        case "132" : echo "金融系" ;$ch2++;break;
        case "133" : echo "國企系" ;$ch2++;break;
        case "134" : echo "財管系" ;$ch2++;break;
        case "135" : echo "企管系" ;$ch2++;break;
        case "136" : echo "觀光系" ;$ch2++;break;
        case "137" : echo "資管系" ;$ch2++;break;
        case "147" : echo "財管系" ;$ch2++;break;
        case "161" : echo "應外系" ;$ch1++;break;
        case "162" : echo "人資系" ;$ch1++;break;
        case "163" : echo "文創系" ;$ch1++;break;
        case "192" : echo "菁英班" ;$another++;break;
        default : echo "查詢不到";$another++;break;
      }
    ?>
    </td>
    <td><?=$row->adddate;?></td>
  </tr>
<?php endforeach?>
</table>
<table border="1">
  <tr>
    <td>建工校區人數</td>
    <td>燕巢校區人數</td>
    <td>菁英班人數</td>
    <td>總人數</td>
  </tr>
  <tr>
    <td><?=$ch1;?></td>
    <td><?=$ch2;?></td>
    <td><?=$another;?></td>
    <td><?=$ch1+$ch2+$another;?></td>
  </tr>
</table>