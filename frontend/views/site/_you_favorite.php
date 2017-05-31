<div class="mdl-1 mdl-songs">
    <div class="title"> 	
        <a href="/song/danh-sach/may-be-you-like" class="txt"> CÓ THỂ BẠN THÍCH</a>
    </div>  
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php $count = 1; ?>
            <?php foreach ($data as $item) { ?>                
                <?php
                if ($count == 4) {
                    echo '</div>';
                    echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
                    $count = 1;
                }
                ?>
                <?php echo $this->render('/song/_item', ['item' => $item->song]); ?>                
                <?php $count++; ?>
            <?php } ?>
        </div>
    </div>
    <?php if ($more) { ?>
        <a class="view-more" href="#">XEM THÊM <i class="fa fa-angle-double-right"></i> </a>
    <?php } ?>
</div>