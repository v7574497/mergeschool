<?php
    $url = base_url("");
    $content = "";
?>

<?php foreach($public_hearing->result() as $row):?>
<?php
    $content = $row->content;
?>
<?php endforeach?>

<table style="margin:0 auto">
    <tr>
        <td width="500"><img style="width:400px" src="<?=$url?>images/public_hearing.jpg"></td>
        <td width="500" valign="top" rowspan="2"><BR>
            <?=$content?>
            <hr style="border:1px dotted">
            <table style="margin:0 auto">
            <?php /*?>
            <tr><td>
                <a href="public_hearing/apply"><button>我要報名</button></a>
            </td></tr>
            <?php */?>
            </table>
        </td>
    </tr>
</table>