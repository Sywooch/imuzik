<div class="form-inline">
  <table class="table table-hover table-vertical">
    <tbody>
<?php
    echo $this->render('/ajax/_item_rbt_search', ['songs' => $songs]);
?>
    </tbody>
  </table>
</div>
<?php if ($page< ceil($pages->totalCount/song_page_limit) ){?>
    <div class="load-more">
        <a class="jscroll-next-default" href="/tim-kiem?k=<?php
        echo urlencode(yii\helpers\Html::encode($k));
        ?>&page=<?php
        $page++;
        echo yii\helpers\Html::encode($page);
        ?>&&typeM=<?php echo 2;?>"><i class="fa fa-angle-down"></i></a>
    </div>
<?php } ?>

