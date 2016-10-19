<meta charset="UTF-8" />
<div class="survey-form">
	<?php
		if($survey->starttime>$nows || $survey->endtime<$nows){
			echo "<script>alert('還沒到投票時間喔~\\n\\n投票時間：2014-05-27 00:00:00~2014-06-08 23:59:59');</script>";
			redirect('survey', 'refresh', 301);
		}
		$attributes = array('class' => 'form-2');
		echo form_open('survey/single/'.$survey->id."/".$option,$attributes);
	?>
	<table style="float:left;margin-left:600px;margin-top:240px;width:490px">
		<tr>
			<td height="100">
				<div class="survey-button">
					<input type="radio" id="radio-1" name="myradio" value="1" <?php echo set_radio('myradio', '1'); ?> />
					<label for="radio-1"><div></div></label>

					<input type="radio" id="radio-2" name="myradio" value="2" <?php echo set_radio('myradio', '2'); ?> />
					<label for="radio-2"><div></div></label>
<?php /*
					<input type="radio" id="radio-3" name="myradio" value="3" <?php echo set_radio('myradio', '3'); ?> />
					<label for="radio-3"><div></div></label>
?*/?>
				</div>
				<?=form_error('myradio');?>
			</td>
		</tr>
		<tr><td height="67"></td></tr>
		<tr>
			<td>
				<input style="width:150px;height:30px;margin-left:120px" type="text" name="sid" value="<?=set_value('sid');?>">
				<?php
					echo form_error('sid');
				?>
			</td>
		</tr>
		<tr>
			<td>
				<input style="width:150px;height:30px;margin-left:120px" type="text" name="tid" value="<?=set_value('tid');?>">
				<?php
					echo form_error('tid');
				?>
			</td>
		</tr>
		<tr><td height="55"</td></tr>
		<tr>
			<td>
				<input style="width:100px" type="text" name="code">
				<label><img src="<?=base_url('font/code.php')?>" onclick="javascript:this.src='<?=base_url('font/code.php')?>?tm='+Math.random();" style="cursor:pointer;" alt="點此刷新驗證碼"/></label> 
				<input type="submit" value="我要投票" onclick="return check_confirm();">
				<?="<BR>".form_error('code');?>
			</td>
		</tr>
		<tr>
		</tr>
	</table>
	</form>
</div>

<script type="text/javascript">
    function check_confirm(){
       var r=confirm("確認送出?");
        if (r==true){
        	return true;
        }
        else{
          return false;
        }
    }
</script>