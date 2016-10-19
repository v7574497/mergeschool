<?php
    $attributes = array('class' => 'form-2');
    echo form_open('public_hearing/apply',$attributes);
?>

<BR><table style="margin:0 auto;" width="600">
    <tr>
        <td colspan="2" align="center">
        【國立高雄應用科技大學 學生會 三校合併座談會 報名資料】<BR><BR
        </td>
    </tr>
    <tr>
        <td align="right">姓名：</td>
        <td>
            <input type="text" name="name" value="<?=set_value('name');?>">
            <?=form_error('name');?>
        </td>
    </tr>
    <tr>
        <td align="right">學號：</td>
        <td><input type="text" name="sid" value="<?=set_value('sid');?>">
            <?php echo form_error('sid');?>
        </td>
    </tr>
    <tr>
        <td align="right">身分證後六碼：</td>
        <td><input type="text" name="tid" value="<?=set_value('tid');?>">
            <?=form_error('tid');?>
        </td>
    </tr>
    <tr>
        <td align="right">驗證碼：</td>
        <td><label><img src="<?=base_url('font/code.php')?>" onclick="javascript:this.src='<?=base_url('font/code.php')?>?tm='+Math.random();" style="cursor:pointer;" alt="點此刷新驗證碼"/></label> 
            <input style="width:70px" type="text" name="code">
            <?=form_error('code');?>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="2"><BR><input type="submit" value="我要報名"></td>
    </tr>
</table>
</form>