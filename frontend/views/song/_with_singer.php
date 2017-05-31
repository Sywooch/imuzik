<?php if (sizeof($data)) { ?>
    <div class="<?php echo $class; ?>">
        <div class="title"> 	
            <a href="/bai-hat-cung-ca-si/<?php echo $song_slug; ?>/<?php echo 1; ?>" class="txt"> CÙNG CA SĨ</a>
            <a class="pull-right view-all" href="/bai-hat-cung-ca-si/<?php echo $song_slug; ?>/<?php echo 1; ?>"><span class="txt-3">XEM THÊM </span> <i class="fa fa-angle-double-right"></i> </a>
        </div> 
        <?php
        foreach ($data as $item) {
            echo $this->render('/song/_item', ['item' => $item]);
        }
        ?>

    </div>
<?php } ?>