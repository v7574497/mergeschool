<?php
	$attributes = array('class' => 'form-2');
	echo form_open('feedback',$attributes);
?>
<div class="feedback">
	<table>
		<tr>
			<td>
				<select name="department" style="width:220px;">
				<option value="1" <?php echo set_select('department', '1', TRUE); ?> >化學工程與材料工程系</option>
				<option value="2" <?php echo set_select('department', '2'); ?> >土木工程系</option>
				<option value="3" <?php echo set_select('department', '3'); ?> >模具工程系</option>
				<option value="4" <?php echo set_select('department', '4'); ?> >工業工程與管理系</option>
				<option value="5" <?php echo set_select('department', '5'); ?> >機械工程系</option>
				<option value="6" <?php echo set_select('department', '6'); ?> >電機工程系</option>
				<option value="7" <?php echo set_select('department', '7'); ?> >電子工程系</option>
				<option value="8" <?php echo set_select('department', '8'); ?> >資訊工程系</option>
				<option value="9" <?php echo set_select('department', '9'); ?> >企業管理系</option>
				<option value="10" <?php echo set_select('department', '10'); ?> >資訊管理系</option>
				<option value="11" <?php echo set_select('department', '11'); ?> >會計系</option>
				<option value="12" <?php echo set_select('department', '12'); ?> >國際企業系</option>
				<option value="13" <?php echo set_select('department', '13'); ?> >財富與稅務管理系</option>
				<option value="14" <?php echo set_select('department', '14'); ?> >金融系</option>
				<option value="15" <?php echo set_select('department', '15'); ?> >觀光管理系</option>
				<option value="16" <?php echo set_select('department', '16'); ?> >應用外語系</option>
				<option value="17" <?php echo set_select('department', '17'); ?> >文化創意產業系</option>
				<option value="18" <?php echo set_select('department', '18'); ?> >人力資源發展系</option>
				</select>
				<select name="grade" style="width:100px;margin-left:10px">
				<option value="1" <?php echo set_select('grade', '1', TRUE); ?> >一年級</option>
				<option value="2" <?php echo set_select('grade', '2'); ?> >二年級</option>
				<option value="3" <?php echo set_select('grade', '3'); ?> >三年級</option>
				<option value="4" <?php echo set_select('grade', '4'); ?> >四年級</option>
				</select>
			</td>
			<td rowspan="4">
				<textarea name="content" style="width:445px;height:220px"><?=set_value('content')?></textarea>
				<?php
					if(form_error('content')){ echo form_error('content');}
					else{ echo "<font>&nbsp<font>";}
				?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="name" value="<?=set_value('name')?>">
				<?=form_error('name');?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="sid" value="<?=set_value('sid')?>">
				<?=form_error('sid');?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="phone" value="<?=set_value('phone')?>">
				<?=form_error('phone');?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="email" value="<?=set_value('email')?>">
				<?=form_error('email');?>
			</td>
			<td>
				<label style="float:left;margin-left:70px"><img src="<?=base_url('font/code.php')?>" onclick="javascript:this.src='<?=base_url('font/code.php')?>?tm='+Math.random();" style="cursor:pointer;" alt="點此刷新驗證碼"/></label> 
				<input type="text" name="code" size="5"  style="width:100px;margin-left:10px;margin-top:5px">
				<?=form_error('code');?>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<BR><input type="submit" onclick="return check_confirm();" value="我要反映">
			</td>
		</tr>
	</table>
</div>
</form><BR><BR>
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

<?php
// placeholder="name"
?>
