<div class="mdl-1 mdl-billboard">
    <div class="title ellipsis"> 
        <a href="#" class="txt"> BẢNG XẾP HẠNG</a> 
    </div>    
    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist">
        <li class="active"><a href="#home" role="tab" data-toggle="tab">Việt Nam</a></li>
        <li><a href="#profile" role="tab" data-toggle="tab">US/UK</a></li>
        <li><a href="#messages" role="tab" data-toggle="tab">Châu Á</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <div class="scroll-pane">
                <?php
                $index = 1;
                foreach ($rankVN as $item) {
                    echo $this->render('/rank/_item', ['item' => $item->song, 'index' => '0' . $index]);
                    $index++;
                }
                ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <div class="scroll-pane">
                <?php
                $index = 1;
                foreach ($rankUK as $item) {
                    echo $this->render('/rank/_item', ['item' => $item->song, 'index' => '0' . $index]);
                    $index++;
                }
                ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            <div class="scroll-pane">
                <?php
                $index = 1;
                foreach ($rankCHAUA as $item) {
                    echo $this->render('/rank/_item', ['item' => $item->song, 'index' => '0' . $index]);
                    $index++;
                }
                ?>
            </div>
        </div>
    </div>            
</div>