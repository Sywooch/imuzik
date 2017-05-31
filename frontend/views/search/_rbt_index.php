<?php

use \yii\widgets\LinkPager;

$this->title = $k; //'Tìm kiếm';
?>

<div class="col-lg-8 col-md-8  col-sm-12">
    <div class="mdl-1 rbt-table mdl-form">
        <?php if (sizeof($songs)) { ?>
            <div class="title">
                <samp href="javascript:void(0);" class="txt"> <?php echo ("Kết quả tìm kiếm"); ?></samp>
            </div>
            <p>
                Có <span class="result-highlight"><?php echo \yii\helpers\Html::encode($pages->totalCount); ?></span> kết quả tìm kiếm nhạc chờ với từ khóa <span class="result-highlight">"<?php echo (\yii\helpers\Html::encode($k)); ?>"</span>
            </p>
            <div class="form-inline">
                <table  class="table table-hover table-vertical">
                    <thead>
                        <tr>
                            <th width="55%" class="first-col">Nhạc chờ</th>
                            <th width="35%">
                    <div class="col-content">
                        <span class="col-form-01">Mã số </span>
                        <span class="col-form-01">Giá </span>
                        <span class="col-form-02">Hết hạn</span>
                    </div>
                    </th>
                    </tr>
                    </thead>
                    <tbody id="table1">
                        <?php
                        echo $this->render('/ajax/_item_search_rbt_ajax', [
                            'songs' => $songs,
                            'k' => $k,
                            'pages' => $pages,
                            'title' => $title,
                            'page' => $page,
                        ]);
                        ?>

                    <?php } else { ?>
                    <div class="title">
                        <samp href="javascript:void(0);" class="txt"> <?php echo ("Kết quả tìm kiếm"); ?></samp>
                    </div>
                    <p>
                        Không tìm thấy kết quả tìm kiếm với từ khóa <span class="result-highlight">"<?php echo \yii\helpers\Html::encode($k); ?>"</span>
                    </p>
                <?php } ?>
        </div>

        <div class="pagging hide-pagging">
            <?php
            // display pagination
            echo LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => 'Tiếp',
                'prevPageLabel' => 'Trước',
                'firstPageLabel' => 'Đầu',
                'lastPageLabel' => 'Cuối',
                'options' => ['class' => 'pager text-left'],
                'nextPageCssClass' => '',
                'maxButtonCount' => 5,
            ]);
            ?>
        </div>
    </div>
    <?php if (\Yii::$app->devicedetect->isDescktop()) { ?>
        <div class="col-lg-4 col-md-4  col-sm-12">
            <?php echo \frontend\Widgets\song\DownWidget::widget(); ?>
        </div>
    <?php } ?>
