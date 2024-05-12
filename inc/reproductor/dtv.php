<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="robots" content="noindex">
    <script src="/cdn-cgi/apps/head/bdXKEs2GnhJP7BcpCR28GDM77_w.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
    <script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
    <script>
        if (window.location.protocol != "https:") {
            //location.href = location.href.replace("http://", "https://");
        }
    </script>
    <?php
    include('../../../inc/conn.php');
    $canal = $_GET['c'];
    $query = mysqli_query($conn, "SELECT * FROM canales WHERE canalId='" . $canal . "'");
    $result = mysqli_fetch_assoc($query);
    $base = "https://slowdus.herokuapp.com/";
    $source = base64_encode($base.$result['canalUrl']);
    $key = $result['key'];
    $key2 = $result['key2'];
    // JW o Bit
    if (strpos($source, "-vos") !== false || $canal == 59 ) {
        $ext = "gg";
    } else {
        $ext = "bit";
    }
    ?>
    <script>
        let getURL = "<?=$source?>";
        let getKEY = "<?=$key?>";
        let getKEY2 = "<?=$key2?>";
        let getEXT = "<?=$ext?>";
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
    <iframe allow="encrypted-media" sandbox="allow-same-origin allow-scripts" src name="iframe" frameborder="0" scrolling="no" allowfullscreen></iframe>
    <script src="dtv.js"></script>
    <script src="../../inc/ads/popunder.php"></script>
</body>
</head>