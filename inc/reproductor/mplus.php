<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
?>
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
<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
<script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
<script src="../../inc/ads/popunder.php"></script>

<style>
    body {
        background-color: #000;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #fff;
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
        display: none;
    }

    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
        background-color: #1487fa;
    }

    .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition,
    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition {
        background-color: #1487fa;
    }

    .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition-marker,
    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
        border-color: #1487fa;
        background-color: #1487fa;
    }
</style>
<br>
<h1>AVISO:</h1>
<h1>LOS CANALES DE MOVISTAR ESPAÑA ESTÁN FUERA DE SERVICIO</h1>
<?php
//include('../../../inc/conn.php');
$canal = $_GET['c'];
$query = mysqli_query($conn, "SELECT * FROM canales WHERE canalId='" . $canal . "'");
$result = mysqli_fetch_assoc($query);
$base = "https://"."slowd".".hero"."kuap"."p.com/";
$source = base64_encode($base.$result['canalUrl']);
$key = base64_encode($result['key']);
$key2 = base64_encode($result['key2']);
$type = $result['canalTipo'];
$ext = "jw";
?>
<script>
    let getURL = "<?= $source ?>";
    let getKEY = "<?= $key ?>";
    let getKEY2 = "<?= $key2 ?>";
    let getEXT = "<?= $ext ?>";
    let getTYPE = "<?= $type ?>";
    if (window.location.protocol != "https:") {
        //location.href = location.href.replace("http://", "https://");
    }
</script>

<body bgcolor='black' style='margin:0' oncontextmenu='return false' onkeydown='return false'>
    <style type="text/css">
        iframe {
            display: block;
            background: #000;
            border: 0;
            height: 100vh;
            width: 100vw
        }
    </style>
    <div class="container">
        <div id="player"></div>
    </div>
    <script src="players/bit.js"></script>
</body>
</head>