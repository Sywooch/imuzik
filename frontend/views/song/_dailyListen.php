<div class="mdl-1 mdl-songs">
    <div class="title"> 	
        <span href="javascript:void(0);" class="txt"> HÔM NAY NGHE GÌ?</span>
    </div> 
    <?php
    foreach ($data as $item) {
        echo $this->render('/song/_item', ['item' => $item->song]);
    }
    ?>
</div>