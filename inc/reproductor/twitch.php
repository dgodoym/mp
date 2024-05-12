<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    // include('../../401.php');
    // exit();
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
//$channel_id = 'slowdmelendez360';
$channel_id = $canalUrl;
?>
<script src="//cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/level-selector@latest/dist/level-selector.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.min.js"></script>
<script src='//cdn.jsdelivr.net/npm/clappr-chromecast-plugin@latest/dist/clappr-chromecast-plugin.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js'></script>
<script src="//ewwink.github.io/clappr-youtube-plugin/clappr-youtube-plugin.js"></script>
<script src= "https://player.twitch.tv/js/embed/v1.js"></script>
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
          var options = {
            width: '100%',
            height: '100%',
            channel: "<?= $channel_id ?>",
            // Only needed if this page is going to be embedded on other websites
            parent: ["127.0.0.1", "<?= $_SERVER['SERVER_NAME'] ?>"]
        };
        var player = new Twitch.Player("player", options);
        player.setVolume(0.5);
    </script>
</body>
</html>