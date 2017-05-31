<input type="hidden" id="audio_file_path" value="<?php echo yii\helpers\Html::encode($file); ?>"/>
<div id="player-bar-player" style="display: none"></div>
<div class="player-bar" id="player-controller">  
    <div class="control-left">
        <a href="#" class="jp-play"><i class="fa icon-play2 selected"></i></a>
        <a href="#" class="jp-pause"><i class="fa icon-pause2"></i></a> 
    </div>
    <div class="control-center">
        <div class="volume">
            <a href="#"><i class="fa icon-volume jp-mute"></i></a>
            <a href="#"><i class="fa icon-volume-off jp-unmute"></i></a>
        </div>	
        <div class="text-duration jp-duration"></div>
        <div class="text-elapsed jp-current-time"></div>
        <div class="slider-horizontal">
            <div class="buffer jp-seek-bar"></div>
            <div class="progess jp-play-bar">
                <div class="knob"></div>
            </div>
        </div>
    </div>
</div>
<?php
//$this->registerJs("
//    $(document).ready(function () {
//        $('#player-bar-player').jPlayer({
//            preload: 'metadata',
//            ready: function (event) {
//                $(this).jPlayer('setMedia', {
//                    mp3: $('#audio_file_path').val()
//                }).jPlayer('play');
//            },
//            cssSelectorAncestor: '#player-controller',
//            swfPath: '/js/jplayer',
//            supplied: 'm4a, mp3,
//            wmode: 'window',
//        });
//    });
//");
?>