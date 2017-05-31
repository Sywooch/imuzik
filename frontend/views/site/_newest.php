<?php if (sizeof($data)) { ?>
    <div class="mdl-1 mdl-songs">
        <div class="title"> 	
            <span href="javascript:void(0);" class="txt"> MỚI CẬP NHẬT</span>
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
                    <?php echo $this->render('/song/_item', ['item' => $item]); ?>                
                    <?php $count++; ?>
                <?php } ?>
            </div>
        </div> 
    </div>
<?php } ?>