<div class="mdl-1 mdl-billboard">
    <div class="title ellipsis"> 
        <a href="javasript:void(0);" class="txt"> TẢI NHIỀU NHẤT</a> 
    </div>    
    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist">
        <li class="active"><a href="#week" role="tab" data-toggle="tab">Tuần</a></li>
        <li><a href="#month" role="tab" data-toggle="tab">Tháng</a></li>
        <li><a href="#all" role="tab" data-toggle="tab">Tất cả</a></li>
        <li><a href="#free" role="tab" data-toggle="tab">Miễn phí</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="week">
            <div class="scroll-pane">
                <?php
                $count = 1;
                foreach ($topDownW as $item) {
                    if ($count <= number_limit) {
                        if ($item->song) {
                            echo $this->render('/rank/_item', ['item' => $item->song, 'index' => '0' . $count]);
                            $count++;
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="month">

        </div>
        <div role="tabpanel" class="tab-pane" id="all">

        </div>
        <div role="tabpanel" class="tab-pane" id="free">

        </div>
    </div>            
</div>