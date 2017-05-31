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

    <?php foreach ($songs as $key => $item) { ?>
        <?php $url = '/bai-nhac-cho/' . $item->huawei_tone_code; ?>
    <tr class="special-text <?php echo ($key == 0)? 'first-item': ''; ?>" id="<?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?>">
        <td>
            <a href="<?php echo $url; ?>" class="bg-color-01"><i class="fa icon-play2"></i></a>
            <div class="wrap-content-table wrap-content-table-2">
                <a class="song-name " href="<?php echo $url; ?>"><?php echo yii\helpers\Html::encode($item->huawei_tone_name); ?></a>
                <span class="singer-name"><?php echo yii\helpers\Html::encode($item->huawei_singer_name); ?></span>
            </div>
        </td>
        <td class="function-more">
            <div class="col-content">
                <span class="col-form-01"><?php echo yii\helpers\Html::encode($item->huawei_tone_code); ?></span>
                <span class="col-form-01"><?php echo number_format($item->huawei_price); ?></span>
                <span class="col-form-02"><?php echo date('d-m-Y', strtotime($item->huawei_available_datetime)); ?></span>
            </div>
        </td>
    </tr>
    <?php } ?>
        </tbody>
    </table>