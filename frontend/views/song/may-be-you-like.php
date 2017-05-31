<?php if (sizeof($data)) { ?>
    <div class="mdl-1 mdl-songs">
        <div class="title"> 	
            <a href="/bai-hat-co-the-ban-thich" class="txt"> CÓ THỂ BẠN THÍCH</a>
            <?php if ($more) { ?>
                <a class="pull-right view-all" href="/bai-hat-co-the-ban-thich"><span class="txt-3">XEM THÊM </span> <i class="fa fa-angle-double-right"></i> </a>
            <?php } ?>
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

    </div>
<?php } ?>