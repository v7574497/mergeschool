<BR>
<ul class="cbp_tmtimeline">
    <?php foreach($history->result() as $row):?>
    <?php
        $dday = ($row->year-1911)."年".$row->month."月";
        if($row->day!="0")
            $dday.=$row->day."日";
    ?>
    <li>
        <time class="cbp_tmtime">
            <span><?=$dday;?></span>
        </time>
        <div class="cbp_tmicon"></div>
        <div class="cbp_tmlabel md-trigger" data-modal="modal-<?=$row->id;?>">
            <h2><?=$row->title;?></h2>
        </div>
    </li>
    <?php endforeach?>
</ul>

<?php foreach($history->result() as $row):?>
<?php
    $content = $row->content;
?>
<div class="md-modal md-effect-1" id="modal-<?=$row->id;?>">
    <div class="md-content">
        <h3><?=$row->title?></h3>
        <div>
            <?=$content?>
            <?php
                $x = 0;
                $len = 0;
                $query = $this->merge_school_model->get_file($row->id);
                foreach($query->result() as $file):
                    if($x){
                        echo "、";
                        if($len>35){
                            $len = 0;
                            echo "<BR>";
                        }
                    }else{
                        echo "<p class='download-content'>相關資料下載：";
                    }
                    $url = base_url("uploads/".$file->url);
                    echo "<a href='$url' target='_blank'>".$file->url."</a>";
                    $len += mb_strlen($file->url);
                    $x++;
                endforeach;
                if($x){
                    echo "</p>";
                }
            ?>
            <button class="md-close">關閉</button>
        </div>
    </div>
</div>
<?php endforeach?>
<BR>
<script src="js/ModalWindowEffects/classie.js"></script>
<script src="js/ModalWindowEffects/modalEffects.js"></script>

<script>
    // this is important for IEs
    var polyfilter_scriptpath = '/js/ModalWindowEffects/';
</script>
<script src="js/ModalWindowEffects/cssParser.js"></script>
<script src="js/ModalWindowEffects/css-filters-polyfill.js"></script>
