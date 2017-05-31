<div class="mdl-1 mdl-billboard">
    <div class="title ellipsis"> 
        <span href="javascript:void(0);" class="txt"> BẢNG XẾP HẠNG</span>
    </div>    
    <!-- Nav tabs -->
    <?php
    $sizeVN = sizeof($rankVN);
    $sizeUK = sizeof($rankUK);
    $sizeCHAUA = sizeof($rankCHAUA);
    ?>
    <ul class="nav nav-pills" role="tablist">
        <?php if ($sizeVN) { ?>
            <li class="active"><a href="#home" role="tab" data-toggle="tab">Việt Nam</a></li>
        <?php } ?>
        <?php if ($sizeUK) { ?>
            <li class="<?php echo (!$sizeVN) ? 'active' : ''; ?>"><a href="#profile" role="tab" data-toggle="tab">US/UK</a></li>
        <?php } ?>
        <?php if ($sizeCHAUA) { ?>
            <li class="<?php echo (!$sizeVN && !$sizeUK) ? 'active' : ''; ?>"><a href="#messages" role="tab" data-toggle="tab">Châu Á</a></li>
        <?php } ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <?php if ($sizeVN) { ?>
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="<?php echo $scroll; ?>">
                    <div>
                        <?php
                        $index = 1;
                        foreach ($rankVN as $item) {
                            echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($index < 10) ? '0' . $index : $index]);
                            $index++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($sizeUK) { ?>
            <div role="tabpanel" class="tab-pane  <?php echo (!$sizeVN) ? 'active' : ''; ?>" id="profile">
                <div class="<?php echo $scroll; ?>">
                    <div>
                        <?php
                        $index = 1;
                        foreach ($rankUK as $item) {
                            echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($index < 10) ? '0' . $index : $index]);
                            $index++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($sizeCHAUA) { ?>
            <div role="tabpanel" class="tab-pane <?php echo (!$sizeVN && !$sizeUK) ? 'active' : ''; ?>" id="messages">
                <div class="<?php echo $scroll; ?>">
                    <div>
                        <?php
                        $index = 1;
                        foreach ($rankCHAUA as $item) {
                            echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($index < 10) ? '0' . $index : $index]);
                            $index++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>            
</div>