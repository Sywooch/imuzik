<div class="mdl-1 mdl-billboard">
    <div class="title ellipsis"> 
        <span href="javascript:void(0);" class="txt"> TẢI NHIỀU NHẤT</span>
    </div>    
    <!-- Nav tabs -->
    <?php
    $weekCount = sizeof($topDownW);
    $monthCount = sizeof($topDownM);
    $totalCount = sizeof($topDownAll);
    $freeCount = sizeof($topFree);
    ?>
    <ul class="nav nav-pills" role="tablist">
        <?php if ($weekCount) { ?>
            <li class="active"><a href="#week" role="tab" data-toggle="tab">Tuần</a></li>
        <?php } ?>
        <?php if ($monthCount) { ?>
            <li class="<?php echo (!$weekCount) ? 'active' : ''; ?>"><a href="#month" role="tab" data-toggle="tab">Tháng</a></li>
        <?php } ?>
        <?php if ($totalCount) { ?>
            <li class="<?php echo (!$weekCount && !$monthCount) ? 'active' : ''; ?>"><a href="#all" role="tab" data-toggle="tab">Tất cả</a></li>
        <?php } ?>
        <?php if ($freeCount) { ?>
            <li class="<?php echo (!$weekCount && !$monthCount && !$totalCount) ? 'active' : ''; ?>"><a href="#free" role="tab" data-toggle="tab">Miễn phí</a></li>
        <?php } ?>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <?php if ($weekCount) { ?>
            <div role="tabpanel" class="tab-pane active" id="week">
                <div>
                    <?php
                    $count = 1;
                    foreach ($topDownW as $item) {
                        if ($count <= $number_limit) {
                            if ($item->song) {
                                echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($count < 10) ? '0' . $count : $count]);
                                $count++;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
        <?php if ($monthCount) { ?>
            <div role="tabpanel" class="tab-pane  <?php echo (!$weekCount) ? 'active' : ''; ?>" id="month">
                <div>
                    <?php
                    $count = 1;
                    foreach ($topDownM as $item) {
                        if ($count <= $number_limit) {
                            if ($item->song) {
                                echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($count < 10) ? '0' . $count : $count]);
                                $count++;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
        <div role="tabpanel" class="tab-pane <?php echo (!$weekCount && !$monthCount) ? 'active' : ''; ?>" id="all">
            <div>
                <?php
                $count = 1;
                foreach ($topDownAll as $item) {
                    if ($count <= $number_limit) {
                        if ($item->song) {
                            echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($count < 10) ? '0' . $count : $count]);
                            $count++;
                        }
                    }
                }
                ?>
            </div>
        </div>
        <?php if ($topFree) { ?>
            <div role="tabpanel" class="tab-pane <?php echo (!$weekCount && !$monthCount && !$totalCount) ? 'active' : ''; ?>" id="free">
                <div>
                    <?php
                    $count = 1;
                    foreach ($topFree as $item) {
                        if ($count <= $number_limit) {
                            if ($item->song) {
                                echo $this->render('/rank/_item', ['item' => $item->song, 'index' => ($count < 10) ? '0' . $count : $count]);
                                $count++;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>            
</div>