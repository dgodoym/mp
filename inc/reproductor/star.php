<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
?>
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
</style>
<?php
// include('../../inc/ads/popunder.php');
echo '
<script>
var getURL = "' . $_GET['r'] . '";
var getKEY = "' . $_GET['key'] . '";
var getKEY2 = "' . $_GET['key2'] . '";
var getIMG = "' . $_GET['img'] . '";
var getTYPE = 9;
</script>'; ?>
<div class="container">
    <div id="player"></div>
</div>
<script src="../../assets/js/reproductores/jw.js"></script>