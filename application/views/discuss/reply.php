<?php
	$form = 'discuss/reply/' . $article->id;
	$title = $this->merge_school_model->chage_str($article->title);
	$attributes = array('class' => 'form-2');
	echo form_open($form,$attributes);
?>
<input type="hidden" name="did" value="<?=$article->id;?>">
<BR><table style="margin:0 auto;">
	<tr>
		<td colspan="2">回覆主題：<?=$title?></td>
	</tr>
	<tr>
		<td>內容：</td>
		<td>
			<textarea name="content" id="content" style="width:400px;height:200px"><?=set_value('content');?></textarea>
			<?=form_error('content');?>
		</td>
	</tr>
	<?php
		$sa_admin = 0;
		if(!empty($_SESSION["account"])){
			$account = $_SESSION["account"];
			$query = $this->sa_model->get_master_id_md5($account);
			$nums = $query->num_rows();
			if($nums){
				$row = $query->row();
				$name = "學生會".$row->name;
				$sa_admin = 1;
			}
		}
	?>
	<?php if($sa_admin){?>
		<input type="hidden" name="sid" value="0">
		<input type="hidden" name="name" value="<?=$name?>">
		<tr>
			<td>姓名：</td>
			<td><?=$name?></td>
		</tr>
	<?php }else{?>
		<tr>
			<td>
				學號：</td>
			<td><input type="text" name="sid" value="<?=set_value('sid');?>">
				<?php echo form_error('sid');?>
			</td>
		</tr>
		<tr>
			<td>
				身分證後六碼：</td>
			<td><input type="text" name="tid" value="<?=set_value('tid');?>">
				<?=form_error('tid');?>
			</td>
		</tr>
	<?php }?>
	<tr>
		<td>
			驗證碼：</td>
		<td><label><img src="<?=base_url('font/code.php')?>" onclick="javascript:this.src='<?=base_url('font/code.php')?>?tm='+Math.random();" style="cursor:pointer;" alt="點此刷新驗證碼"/></label> 
			<input type="text" name="code">
			<?=form_error('code');?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><BR><input type="submit" value="回覆文章"></td>
	</tr>
</table>
</form>