
<table class="mytable">
    <thead>
        <tr>
            <th width="600">主題</th>
            <th width="100">作者</th>
            <th width="200">更新日期</th>
            <th width="50">顯示</th>
            <th width="50">管理</th>
        </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody>
		<?php foreach ($discuss as $row): ?>
		<tr>
			<td width="600"><?=$row->title;?></td>
			<td width="100"><?=$row->name;?></td>
			<td width="200"><?=$row->updatedate;?></td>
			<?php echo form_open('admin/discuss');?>
			<td width="50">
				<?php
					if($row->show=="1"){
						$show = true;
						$unshow = false;
					}else{
						$show = false;
						$unshow = true;
					}
				?>
				<input type="hidden" name="did" value="<?=$row->id?>">
				<input type="hidden" name="updatedate" value="<?=$row->updatedate?>">
				<select name="show">
					<option value="1" <?php echo set_select('show', '1', $show); ?> >顯示</option>
					<option value="0" <?php echo set_select('show', '0', $unshow); ?> >不顯示</option>
				</select>
			</td>
            <td width="50"><input type="submit" value="修改"></td>
			</form>
		</tr>
		<?php endforeach ?>
    </tbody>
</table>