<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    //include('../../401.php');
    //exit();
}
?>
<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
<script> //ConsoleBan.init({ redirect: '../../?p=401' }); </script>
<section class="container text-center pt-5 mt-2 mt-md-4 mt-lg-5">
    <style>
        .canal-card {
            cursor: pointer;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .embed-responsive {
            background-color: #000;
            position: relative;
            box-shadow: 2px 2px 8px 2px #6366f1;
            transition: all 0.3s ease;
            border-radius: 10px;
            height: 50vh;
            overflow: hidden;
            text-align: center;
            float: center;
        }

        #player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50vh;
        }

        #channelsList {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="embed-responsive">
                <div id="player">Selecciona un canal para cargar el reproductor</div>
            </div>
            <hr>
            <a id="reloadJw" class="btn btn-outline-secondary w-100">
                Recargar Reproductor
            </a>
        </div>
</section>
<script src="assets/js/reproductores/adult.js"></script>