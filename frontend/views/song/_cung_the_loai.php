<div class="<?php echo $class; ?>">
    <div class="title"> 	
        <a href="/bai-hat-cung-the-loai/<?php echo $song_id; ?>" class="txt"> CÙNG THỂ LOẠI</a>
        <a class="pull-right view-all" href="/bai-hat-cung-the-loai/<?php echo $song_id; ?>"><span class="txt-3">XEM THÊM </span> <i class="fa fa-angle-double-right"></i> </a>
    </div> 
    <?php
    foreach ($data as $item) {
        echo $this->render('/song/_item', ['item' => $item]);
    }
    ?>

</div>