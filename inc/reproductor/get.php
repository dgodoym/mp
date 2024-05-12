<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="robots" content="noindex" />
<meta name="referrer" content="none">
<script src="//cdn.bitmovin.com/player/web/8/bitmovinplayer.js"></script>
<script src="//cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/level-selector@latest/dist/level-selector.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.min.js"></script>
<script src='//cdn.jsdelivr.net/npm/clappr-chromecast-plugin@latest/dist/clappr-chromecast-plugin.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js'></script>
<script src="//ewwink.github.io/clappr-youtube-plugin/clappr-youtube-plugin.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<style>
    body {
        background-color: #000;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
    }

    .container {
        width: 100% !important;
        height: 100vh !important;
    }

    #player,
    #iframe {
        height: 100% !important;
        width: 100% !important;
        border: none;
    }

    .bmpui-ui-watermark {
        background-image: url("https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png");
        top: 0;
        left: 0;
        min-width: 5em;
    }

    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
        background-color: #6366f1;
    }

    .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition,
    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition {
        background-color: #6366f1;
    }

    .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition-marker,
    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
        border-color: #6366f1;
        background-color: #6366f1;
    }

    .bmpui-ui-selectbox,
    .bmpui-on {
        color: #6366f1;
    }
</style>
<?php
include("../componentes/geoplugin.php");
$id = $_GET['id'];
$url = "https://absimile.com/liga1.php?id=" . $id;
$liga1Content = file_get_contents($url);
preg_match('/source:\s*"(.*?)"/', $liga1Content, $matches);
if (isset($matches[1])) {
    $sourceUrl = $matches[1];
    str_replace('81.91.178.190',$geoplugin->ip, $sourceUrl);
} else {
    echo "<h1>No se ha podido encontrar el canal.</h1>";
}
?>
<div class="container">
    <div id="player"></div>
</div>
<script>
    var player = new Clappr.Player({
        source: "<?= $sourceUrl ?>",
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
        muted: false,
    });
</script>