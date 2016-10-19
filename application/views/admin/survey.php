<table border="1" style="margin:0 auto;">
<tr><td>
<a href="<?=base_url('admin/survey_insert')?>">新增意調</a>
</td></tr>
<table border="1" style="margin:0 auto;">
  <tr>
    <td>主題</td><td>開始時間</td><td>結束時間</td>
    <td colspan="2">管理</td>
  </tr>
	<?php foreach($survey->result() as $row):?>
	<tr>
		<td><?=$row->title;?></td>
		<td><?=$row->startdate;?></td>
		<td><?=$row->enddate;?></td>
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
    var id="<?php echo $id;?>";
	var update_url = url+"admin/survey_update/";
	var delete_url = url+"admin/survey_delete/";
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

<BR><table border="1" style="margin:0 auto;">
  <tr>
    <td colspan="3" align="center">三校合併意願調查 - 日間部學生</td>
  </tr>
  <tr>
    <td>同意</td><td>不同意</td><td>沒意見</td>
  </tr>
  <tr>
    <td><?=$this->merge_school_model->get_survey_data(3,1,1);?></td>
    <td><?=$this->merge_school_model->get_survey_data(3,1,2);?></td>
    <td><?=$this->merge_school_model->get_survey_data(3,1,3);?></td>
  </tr>
</table>

<BR><table border="1" style="margin:0 auto;">
  <tr>
    <td colspan="2" align="center">三校合併草案意願調查 - 日間部學生</td>
  </tr>
  <tr>
    <td>同意</td><td>不同意</td>
  </tr>
  <tr>
    <td><?=$this->merge_school_model->get_survey_data(4,1,1);?></td>
    <td><?=$this->merge_school_model->get_survey_data(4,1,2);?></td>
  </tr>
</table>

<BR><table border="1" style="margin:0 auto;">
  <tr>
    <td colspan="2" align="center">三校合併草案意願調查 - 研究生學生</td>
  </tr>
  <tr>
    <td>同意</td><td>不同意</td>
  </tr>
  <tr>
    <td><?=$this->merge_school_model->get_survey_data(4,2,1);?></td>
    <td><?=$this->merge_school_model->get_survey_data(4,2,2);?></td>
  </tr>
</table>
