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
<script> ConsoleBan.init({ redirect: '../../?p=401' }); </script>
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
$getUrl = base64_decode($_GET['s']);

//list($urlParte, $resto) = explode("&img=", $getUrl);
list($imagenParte, $resto) = explode("&key=", $getUrl);
list($keyParte, $key2Parte) = explode("&key2=", $resto);
// Obtener las partes de la URL
//$urlParte = urldecode($urlParte);
// Obtener la imagen
$urlParte = urldecode($imagenParte);
// Obtener la key
$key = urldecode($keyParte);
// Obtener la key2
$key2 = urldecode($key2Parte);

//echo $getUrl;
echo '
<script>
var getURL = "' . $urlParte . '";
var getKEY = "' . $key . '";
var getIMG = "' . $img . '";
var getKEY2 = "' . $key2 . '";
var getTYPE = 9;
</script>'; ?>
<div class="container">
    <div id="player"></div>
</div>
<script src="../../assets/js/reproductores/jw.js"></script>