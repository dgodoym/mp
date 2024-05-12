<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
$api_key = 'AIzaSyBbCLCMwGQ4YA-_B3YWDiKxDAY8dwAhCdc';
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
$canal = $_GET['c'];
include('../../inc/conn.php');
// Fuente Alterna
if (isset($_GET['f']) && $_GET['f'] !== null) {
    $canal = ($_GET['f']);
    $canales = mysqli_query($conn, "SELECT * FROM fuentes WHERE fuenteId = '$canal'");
    $result = mysqli_fetch_array($canales);
    $canalId = $result['canalId'];
    $canalNombre = $result['canalNombre'];
    $canalUrl = $result['canalUrl'];
    $key1 = $result['key'];
    $key2 = $result['key2'];
    $canalImg = $result['canalImg'];
    $canalCategoria = $result['canalCategoria'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['tipo'];
} elseif (isset($_GET['c']) && $_GET['c'] !== null) {
    $canal = ($_GET['c']);
    $canales = mysqli_query($conn, "SELECT * FROM canales WHERE canalId = '$canal'");
    $result = mysqli_fetch_array($canales);
    $canalId = $result['canalId'];
    $canalNombre = $result['canalNombre'];
    $canalUrl = $result['canalUrl'];
    $key1 = $result['key'];
    $key2 = $result['key2'];
    $canalImg = $result['canalImg'];
    $canalCategoria = $result['canalCategoria'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['canalTipo'];
}
//$channel_id = 'UCIs6fmAXOI1K2jgkoBdWveg';
$channel_id = $canalUrl;
$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=$channel_id&type=video&eventType=live&key=$api_key";

$response = file_get_contents($url);
$json = json_decode($response, true);

if (isset($json['items'][0]['id']['videoId'])) {
    $video_id = $json['items'][0]['id']['videoId'];
} else {
    $video_id = '';
}

if (!empty($video_id)) {
    $url = "https://www.youtube.com/get_video_info?video_id=$video_id&el=live";
    $video_info = file_get_contents($url);
    parse_str($video_info, $video_details);
}
?>
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
        width: 100% !important;
        height: 100vh !important;
    }

    #player {
        height: 100% !important;
        width: 100% !important;
    }
</style>

<body>
    <div class="container">
        <div id="player"></div>
    </div>

    <script>
        let source = "<?= $video_id ?>";
        var player = new Clappr.Player({
            source: source,
            poster: 'https://i.ytimg.com/vi/'+source+'/hqdefault.jpg',
            parentId: "#player",
            watermark: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
            position: "top-left",
            plugins: [LevelSelector, ClapprPip.PipButton, ClapprPip.PipPlugin, DashShakaPlayback, ChromecastPlugin, ClapprPip.PipButton, ClapprPip.PipPlugin, YoutubePlugin, YoutubePluginControl],
            YoutubeVars : {"languageCode":"en"},
            events: {
                onReady: function () {
                    console.log("El evento onReady se ha disparado.");
                    var plugin = this.getPlugin("click_to_pause");
                    plugin && plugin.disable();
                },
                onPlay: function () {
                    console.log("El evento onPlay se ha disparado.");
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
            autoPlay: false,
            muted: false,
        });
        player.play();
        // Pausar después de 2 segundos (2000 milisegundos)
        setTimeout(() => {
            //player.pause();
        }, 2000);
    </script>
</body>
</html>