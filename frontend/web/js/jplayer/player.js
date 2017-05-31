//$('#player-bar-player').jPlayer({
//    swfPath: '/js/jplayer',
//    solution: 'html, flash',
//    supplied: 'm4a, mp3',
//    preload: 'metadata',
//    volume: 0.32,
//    muted: false,
//    backgroundColor: '#000000',
//    cssSelectorAncestor: '#player-bar-player',
//    ready: function (event) {
//        $(this).jPlayer("setMedia", $('#audio_file_path').val()).jPlayer("play");
//    },
//    cssSelector: {
//        videoPlay: '.control-left',
//        play: '.icon-play2',
//        pause: '.icon-pause2',
//        stop: '.jp-stop',
//        seekBar: '.jp-seek-bar',
//        playBar: '.jp-play-bar',
//        mute: '.jp-mute',
//        unmute: '.jp-unmute',
//        volumeBar: '.jp-volume-bar',
//        volumeBarValue: '.jp-volume-bar-value',
//        volumeMax: '.jp-volume-max',
//        playbackRateBar: '.jp-playback-rate-bar',
//        playbackRateBarValue: '.jp-playback-rate-bar-value',
//        currentTime: '.text-elapsed',
//        duration: '.text-duration',
//        title: '.jp-title',
//        fullScreen: '.jp-full-screen',
//        restoreScreen: '.jp-restore-screen',
//        repeat: '.jp-repeat',
//        repeatOff: '.jp-repeat-off',
//        gui: '.jp-gui',
//        noSolution: '.jp-no-solution'
//    },
//    errorAlerts: false,
//    warningAlerts: false
//});
var imuzikPlayer;
$(document).ready(function () {
    imuzikPlayer = $("#player-bar-player").jPlayer({
        preload: 'metadata',
        ready: function (event) {
            $(this).jPlayer("setMedia", {
                mp3: $('#audio_file_path').val()
            }).jPlayer("play");
        },
        cssSelectorAncestor: '#player-controller',
        swfPath: "/js/jplayer",
        supplied: "m4a, mp3",
        wmode: "window",
    });
}); 