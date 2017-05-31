<div class="mdl-1 mdl-songs">
    <div class="title"> 	
        <a href="#" class="txt"> HÔM NAY NGHE GÌ?</a>
    </div> 
    <?php
    foreach ($data as $item) {
        echo $this->render('/song/_item', ['item' => $item->song]);
    }
    ?>
</div>