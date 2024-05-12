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
// ADS
include('../../inc/ads/intersticial.php');
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
    (strpos($canalUrl, "masmediatv") !== false) ? ($key1 = $key2 = "01010101010101010101010101010101") : "";
}
// Si el tipo es CK
if ($canalTipo == 9) {
    // Canales DTV
    if (strpos($canalUrl, "//dtvott-") !== false || strpos($canalUrl, ".dtvott") !== false) {
        // JW o Bit
        if (strpos($canalUrl, "-vos") !== false || $canalId == 59) {
            $ext = "irjw";
        } else {
            $ext = "irjw";
        }
        // Encriptamos la URL
        $base = "";
        $canalUrl = $base . $canalUrl;
        $canalUrl = base64_encode($canalUrl);
        ?>
        <script>
            let getURL = "<?= $canalUrl ?>";
            let getKEY = "<?= $key1 ?>";
            let getKEY2 = "<?= $key2 ?>";
            let getTYPE = "<?= $canalTipo ?>";
            let getEXT = "<?= $ext ?>";
        </script>
        <div class="container">
            <iframe id="iframe" src allow="encrypted-media" allowfullscreen></iframe>
        </div>
        <script src="../../assets/js/reproductores/dtv.js"></script>
        <?php
    } else {
        // Requieren JW
        if (strpos($canalUrl, "dazn-cdn") || strpos($canalUrl, "livedazn") || strpos($canalUrl, "livewwdazn") || strpos($canalUrl, "daznedge") || strpos($canalUrl, "director.streaming") || strpos($canalUrl, "stvacdn") || strpos($canalUrl, "izzigo.") || strpos($canalUrl, "vidgo.com")  || strpos($canalUrl, "tglmp") || strpos($canalUrl, "liveusp") || strpos($canalUrl, "live-nl-") || strpos($canalUrl, "upcbroadband") || strpos($canalUrl, "ssc-") || strpos($canalUrl, "cvatt") || strpos($canalUrl, "latamvosliveclarovideo") || strpos($canalUrl, "aiv-cdn") || strpos($canalUrl, "peacocktv") || strpos($canalUrl, "zapitv") ||strpos($canalUrl, "vodafone") || strpos($canalUrl, "skycdp") || strpos($canalUrl, "ssc") || strpos($canalUrl, "9c9media") || strpos($canalUrl, "dmdsdp")) {
            // Vidgo Requiere Proxy
            if (strpos($canalUrl, "vidgo.com")) {
                $canalUrl = "https://slowdus.herokuapp.com/" . $canalUrl;
            }
            // Encriptamos la URL
            $canalUrl = base64_encode($canalUrl); ?>
            <script>
                let getURL = "<?= $canalUrl ?>";
                let getKEY = "<?= $key1 ?>";
                let getKEY2 = "<?= $key2 ?>";
                let getTYPE = "<?= $canalTipo ?>";
            </script>
            <div class="container">
                <div id="player"></div>
            </div>
            <script src="../../assets/js/reproductores/jw.js"></script>
            <?php
        } else {
            // Encriptamos la URL
            $canalUrl = base64_encode($canalUrl); ?>
            <script>
                let getURL = "<?= $canalUrl ?>";
                let getKEY = "<?= $key1 ?>";
                let getKEY2 = "<?= $key2 ?>";
                let getTYPE = "<?= $canalTipo ?>";
            </script>
            <div class="container">
                <div id="player"></div>
            </div>
            <script src="../../assets/js/reproductores/bit.js"></script>

        <?php }
    }
} else {
    // Encriptamos la URL
    $canalUrl = base64_encode($canalUrl); ?>
    <script>
        let getURL = "<?= $canalUrl ?>";
        let getKEY = "<?= $key1 ?>";
        let getKEY2 = "<?= $key2 ?>";
        let getTYPE = "<?= $canalTipo ?>";
    </script>
    <div class="container">
        <div id="player"></div>
    </div>
    <script src="../../assets/js/reproductores/bit.js"></script>
    <script src="../../inc/ads/push.php"></script>

<?php }
?>