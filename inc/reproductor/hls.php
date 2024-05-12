<script src="//cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/level-selector@latest/dist/level-selector.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.min.js"></script>
<script src='//cdn.jsdelivr.net/npm/clappr-chromecast-plugin@latest/dist/clappr-chromecast-plugin.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js'></script>
<script src="//ewwink.github.io/clappr-youtube-plugin/clappr-youtube-plugin.js"></script>
<style>
    body {
        background: #000;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 100%!important;
        height: 100vh!important;
    }
    #player {
        height: 100%!important;
        width: 100%!important;
    }
    .media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar] , .spinner-three-bounce[data-spinner]>div {
    background-color: #6366f1!important;
    }
    .media-control-center-panel , .level_selector[data-level-selector] button , .dvr-controls[data-dvr-controls] {
        color: #6366f1!important;
        cursor: pointer;
    }
    .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg path {
        fill: #6366f1!important;
    }

</style>
<div id="player"></div>
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../conn.php');
// ADS
include('../ads/intersticial.php');

// Fuente Alterna
if (isset($_GET['f']) && $_GET['f'] !== null) {
    $canal = ($_GET['f']);
    $canales = mysqli_query($conn, "SELECT * FROM fuentes WHERE fuenteId = '$canal'");
    $result = mysqli_fetch_array($canales);
    $source = base64_encode($result['canalUrl']);
} elseif (isset($_GET['c']) && $_GET['c'] !== null) {
    $canal = ($_GET['c']);
    $canales = mysqli_query($conn, "SELECT * FROM canales WHERE canalId = '$canal'");
    $result = mysqli_fetch_array($canales);
    $source = base64_encode($result['canalUrl']);
}
echo '
    <script>
    var player = new Clappr.Player({
        source: atob("' . $source . '"),
        parentId: "#player",
        watermark: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
        position: "top-left",
        plugins: [LevelSelector, ClapprPip.PipButton, ClapprPip.PipPlugin, DashShakaPlayback, ChromecastPlugin, ClapprPip.PipButton, ClapprPip.PipPlugin],
        events: {
            onReady: function () {
                var plugin = this.getPlugin("click_to_pause");
                plugin && plugin.disable();
            },
        },
        chromecast: {
            appId: "9DFB77C0",
            contentType: "video/mp4",
        },
        gaAccount: "G-Z7958KV9CY",
        gaTrackerName: "MyPlayerInstance",
        height: "100%",
        width: "100%",
        autoPlay: true,
        muted: false
    });
    player.play();
    // Pausar después de 2 segundos (2000 milisegundos)
    setTimeout(() => {
        player.pause();
    }, 2000);
    </script>
    ';