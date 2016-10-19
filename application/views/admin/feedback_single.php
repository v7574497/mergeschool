<?php
	$department = array("0","化學工程與材料工程系","土木工程系","模具工程系",
		"工業工程與管理系","機械工程系","電機工程系","電子工程系","資訊工程系",
		"企業管理系","資訊管理系","會計系","國際企業系","財富與稅務管理系",
		"金融系","觀光管理系","應用外語系","文化創意產業系","人力資源發展系");
	$grade = array("0","一年級","-二年級","三年級","四年級");
	$content = $feedback->content;
	$content = $this->merge_school_model->chage_str($content);
?>
<?php echo form_open('admin/feedback/'.$feedback->id); ?>
<table style="margin:0 auto;">
	<tr>
		<td>
			狀態：
			<?php
				$s1 = true;
				$s2 = true;
				if($feedback->status==1){
					$s2 = false;
				}else if($feedback->status==2){
					$s1 = false;
				}
			?>
			<select name="status">
				<option value="1" <?php echo set_select('status', '1',$s1); ?> >未解決</option>
				<option value="2" <?php echo set_select('status', '2',$s2); ?> >解決</option>
			</select>	
			<input type="submit" value="修改狀態">
		</td>
	</tr>
	<tr>
		<td>就讀科系年級：<?=$department[$feedback->department];?>
			<?=$grade[$feedback->grade];?>
		</td>
	</tr>
	<tr>
		<td>
			姓名：<?=$feedback->name;?>
		</td>
	</tr>
	<tr>
		<td>
			學號：<?=$feedback->sid;?>
		</td>
	</tr>
	<tr>
		<td>
			聯絡電話：<?=$feedback->phone;?>
		</td>
	</tr>
	<tr>
		<td>
			電子郵件地址：<?=$feedback->email;?>
		</td>
	</tr>
	<tr>
		<td>
			反映內容：<pre><?=$content;?></pre>
		</td>
	</tr>
</table>
</form>