<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

// RADIO
if (isset($_GET['source'])) {
    include('inc/reproductor/radio.php');
    exit();
}

if (isset($_GET['c'])) {
    $canal = $_GET['c'];
    $canalTipo;
    $canalNombre;
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalId = $canal");
    $result = mysqli_fetch_assoc($channels);
    $canalId = $result['canalId'];
    $canalImg = $result['canalImg'];
    $canalNombre = $result['canalNombre'];
    $canalCategoria = $result['categoriaNombre'];
    $categoria = $result['categoriaId'];
    // Fuentes Alternas
    if (isset($_GET['f'])) {
        $canalAlt = $_GET['f'];
        $channels = mysqli_query($conn, "SELECT * FROM fuentes
        INNER JOIN canales ON fuentes.canal = canales.canalId
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
        INNER JOIN paises ON fuentes.pais = paises.paisId
        WHERE fuenteId = $canalAlt");
        $result = mysqli_fetch_assoc($channels);
        $canalId = $result['canal'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['canalNombre'];
        $canalCategoria = $result['categoriaNombre'];
        $categoria = $result['categoriaId'];
        $canalUrl = $result['canalUrl'];
        $canalPais = $result['pais'];
        $canalTipo = $result['tipo'];
        // Verificar que "c" coincida en BD
        if ($canal !== $result['canal']) {
            $canal = $result['canal'];
        }
    }
}
// Verificar tipo
if (empty($canalTipo)) {
    $canalTipo = 'default';
}
// iframes
if (isset($_GET['title'])) {
    $canalNombre = $_GET['title'];
}
// NBA LP
elseif (isset($_GET['nbalp'])) {
    $canalNombre = " League Pass";
}
// DB
elseif (isset($_GET['id'])) {
    $partidoID = $_GET['id'];
    $partido = mysqli_query($conn, "SELECT p.id, p.local, p.visitante,
    e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
    e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante
    FROM partidos p
    JOIN equipos e1 ON p.local = e1.equipoId
    JOIN equipos e2 ON p.visitante = e2.equipoId
    WHERE p.id='$partidoID'");
    $ross = mysqli_fetch_assoc($partido);
    $canalNombre = $ross['equipo_local'] . " vs " . $ross['equipo_visitante'];
}
?>
<div id="toast-container" class="position-fixed bottom-0 end-0 p-3">
</div>

<section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">

        <!-- Content -->
        <div id="playerCol" class="col-lg-9">
            <div class="row">
                <div class="col-9">
                    <h2 class="h4"> Ver
                        <?= ucwords($canalNombre) ?> En Vivo
                    </h2>
                </div>
                <div class="col-3">
                    <!-- Toggle Size Player -->
                    <div class="d-flex justify-content-end">
                        <div id="mode-switch" class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4">
                            <input type="checkbox" class="form-check-input" id="expandirBtn" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Cambiar modo teatro">
                            <label class="form-check-label d-none d-sm-block" for="expandirBtn">Normal</label>
                            <label class="form-check-label d-none d-sm-block" for="expandirBtn">Teatro</label>
                        </div>
                    </div>
                </div>
                <?php
                if (!isset($_GET['c']) && $_GET['c'] == 337) {
                ?>
                <div class="col-12">
                    <div id="alertaPlayerVip" class="alert d-flex alert-secondary" role="alert">
                        <i class="bx bx-bug lead me-3"></i>
                        <div>
                            <i class="flag <?=$result['paisNombre']?>"></i>
                            ¿El canal no funciona? <a href="#" class="alert-link">Contáctanos</a> para obtener acceso sin VPN y convertirte en VIP.
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <!-- Reproductor -->
            <div class="gallery mb-4 pb-2">
                <a id="playerFake"
                    style="display: none"
                    href="https://www.highcpmrevenuegate.com/mkd1fhhe?key=81193c57b7f58377107604b71a3e49aa"
                    target="_blank">
                    <img class="img-fluid" src="assets/img/player_img.png" alt="">
                </a>
                <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
                    <?php
                    // Definir configuraciones para diferentes casos
                    $configurations = [
                        'r' => ["star.php", ['r', 'key', 'key2', 'img']],
                        's' => ["hbo.php", ['s', 'key', 'key2']],
                        'adult' => ["adult.php", []],
                        'nba' => ["", ['ifr']],
                        'nfl' => ["", ['ifr']],
                        'mlb' => ["", ['ifr']],
                        'evento' => ["", ['ifr']],
                        'hls' => ["hls.php", ['c']],
                        '10' => ["twitch.php", ['c', 'f']],
                        '11' => ["ckm.php", ['c', 'f']],
                        '12' => ["mplus.php", ['c', 'f']],
                        '9' => ["ck.php", ['c', 'f']],
                        '6' => ["bm.php", ['c', 'f']],
                        '1' => ["hls.php", ['c', 'f']],
                        '3' => ["yt.php", ['c', 'f']],
                        '2' => ["frame.php", ['c', 'f']] // For $canalTipo == 2, handle $canalUrl separately
                    ];

                    // Obtener el tipo de configuración
                    if (isset($_GET['ifr']) || isset($_GET['evento'])) {
                        // NBA LP
                        if (isset($_GET["nbalp"])) {
                            $idFrame = $_GET["nbalp"];
                            $src = "//irtvhn.info/nba.php?id=" . $idFrame;
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='$src'";
                            echo "<iframe {$src}></iframe>";

                        } else {
                            $decodedIfr = base64_decode($_GET['ifr']);
                            $canalUrl = $decodedIfr;
                            // Validar la URL antes de mostrarla en el iframe
                            if (filter_var($decodedIfr, FILTER_VALIDATE_URL)) {
                                // Si la URL es válida, mostrarla en el iframe
                                $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='{$decodedIfr}'";
                                echo "<iframe {$src}></iframe>";
                            } else {
                                // Si la URL no es válida, mostrar un mensaje de error o redirigir a una página de error
                                $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='?p=404'";
                                echo "<iframe {$src}></iframe>";
                            }
                        }
                    } elseif (isset($_GET['r']) && isset($_GET['img'])) {
                        $config = $configurations['r'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";
                    } elseif (isset($_GET['s'])) {
                        $config = $configurations['s'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";
                    } else {
                        // Configurar los claro && Flow
                        if (strpos($canalUrl, "claro") || strpos($canalUrl, "cvatt")) {
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='//clarovideo.irtvhn.info?c=$canalAlt'";
                        }
                        // Configurar los IZZI
                        elseif (strpos($canalUrl, "izzigo")) {
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='//izzigo.irtvhn.info?c=$canalAlt'";
                        } elseif (isset($canalTipo) && isset($configurations[$canalTipo])) {
                            // Obtener el tipo de canal de la base de datos y verificar si existe en las configuraciones
                            $config = $configurations[$canalTipo];

                            // Construir los parámetros para la URL del iframe
                            $params = implode("&", array_map(function ($param) {
                                return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                            }, $config[1]));

                            // Construir la URL del iframe con la configuración correspondiente
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/{$config[0]}?{$params}'";
                        } else {
                            // Manejar el caso por defecto o mostrar un error si el tipo de canal no es válido
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/ck.php'";
                        }

                        // Imprimir el iframe
                        echo "<iframe {$src}></iframe>";
                    }
                    ?>

                </div>
            </div>
            <hr class="mb-4">
            <div class="row">
                <div class="col-4">
                    <?php (isset($_GET['c']) ? include('inc/componentes/fuentes.php') : ''); ?>
                </div>
                <div class="col-8">
                    <script src="inc/ads/related-ad.php"></script>
                </div>
            </div>
        </div>

        <!-- Votos -->
        <div id="chatCol" class="col-lg-3 position-relative">
            <div class="sticky-top " style="top: 105px !important;">
                <?php if (isset($_GET['c'])): ?>
                    <div class="row text-center">
                        <div class="col-6">
                            <?php
                            // Consulta SQL para obtener el recuento de votos para cada canal
                            $sql = "SELECT canal_id, 
                            SUM(CASE WHEN voto = 'like' THEN 1 ELSE 0 END) as like_count,
                            SUM(CASE WHEN voto = 'dislike' THEN 1 ELSE 0 END) as dislike_count
                            FROM votos WHERE canal_id = $canalAlt
                            GROUP BY canal_id";

                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            if ($result->num_rows > 0) {
                                $likeCount = $row['like_count'];
                                $dislikeCount = $row['dislike_count'];
                            } else {
                                $likeCount = 0;
                                $dislikeCount = 0;
                            }
                            // Verificar si el usuario ha dado "like" para este canal
                            $sqlCheckLike = "SELECT * FROM votos WHERE usuario_id = $_SESSION[usuario_id] AND canal_id = $canalAlt AND voto = 'like'";
                            $resultCheckLike = $conn->query($sqlCheckLike);
                            $userHasLiked = ($resultCheckLike->num_rows > 0);
                            // Verificar si el usuario ya ha dado like
                            $likeClass = ($userHasLiked) ? 'active' : '';
                            // Verificar si el usuario ha dado "dislike" para este canal
                            $sqlCheckDislike = "SELECT * FROM votos WHERE usuario_id = $_SESSION[usuario_id] AND canal_id = $canalAlt AND voto = 'dislike'";
                            $resultCheckDislike = $conn->query($sqlCheckDislike);
                            $userHasDisliked = ($resultCheckDislike->num_rows > 0);
                            // Verificar si el usuario ya ha dado dislike
                            $dislikeClass = ($userHasDisliked) ? 'active' : '';
                            ?>
                            <button data-canal-id="<?= $canalAlt ?>" type="button"
                                class="<?= (!isset($_SESSION['usuario_id']) || !isset($_COOKIE['usuario_id'])) ? "disabled" : "" ?> btn btn-sm btn-outline-success like-btn <?= $likeClass ?>">
                                <i class="bx bx-like me-2 lead"></i>
                                <span id="like-count-<?= $canalAlt ?>" class="badge bg-primary shadow-primary mt-n1 ms-3">
                                    <?= $likeCount ?>
                                </span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button data-canal-id="<?= $canalAlt ?>" type="button"
                                class="<?= (!isset($_SESSION['usuario_id']) || !isset($_COOKIE['usuario_id'])) ? "disabled" : "" ?> btn btn-sm btn-outline-danger dislike-btn <?= $dislikeClass ?>">
                                <i class="bx bx-dislike me-2 lead"></i>
                                <span id="dislike-count-<?= $canalAlt ?>" class="badge bg-danger shadow-primary mt-n1 ms-3">
                                    <?= $dislikeCount ?>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- AJAX -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="inc/componentes/like.js"></script>
                <?php endif ?>
                <br>
                <!-- Chat & Post -->
                <!-- Chat -->
                <div class="rounded-3">
                    <iframe id="twitch-chat-embed" class="rounded-3" src height="560" width="100%"></iframe>
                </div>
            </div>
        </div>
        <script src="assets/js/playconfig3.js"></script>
    </div>
    </div>
</section>
<!-- Relacionados -->
<?php include('inc/componentes/relacionados.php'); ?>