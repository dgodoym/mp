<?php
session_start();
// Guardar referer
if ($_GET['p'] !== "login") {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>iRaffle TV | Televisión Gratis por Internet</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="iRaffle TV - Eventos deportivos y canales de televisión en vivo completamente gratis">
    <meta name="keywords"
        content="Canales de TV gratis, ver tele gratis, television gratis, partidos gratis, iRaffle TV.">
    <meta name="author" content="iRaffle TV">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon and Touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#6366f1">
    <link rel="shortcut icon" href="assets/favicon.png">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="assets/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L0M9BFKRR9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-L0M9BFKRR9');
    </script>

    <!-- Vendor Styles -->
    <link rel="stylesheet" media="screen" href="assets/vendor/boxicons/css/boxicons.min.css" />
    <link rel="stylesheet" media="screen" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/toastify/toastify.min.css">

    <!-- Main Theme Styles + Bootstrap -->
    <link rel="stylesheet" media="screen" href="assets/css/theme.css">

    <!-- Events Styles -->
    <link rel="stylesheet" media="screen" href="assets/css/events.css">
    <link rel="stylesheet" media="screen" href="assets/css/flags.css">

    <!-- Page loading styles -->
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all .4s .2s ease-in-out;
            transition: all .4s .2s ease-in-out;
            background-color: #fff;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }

        .dark-mode .page-loading {
            background-color: #0b0f19;
        }

        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }

        ::-webkit-scrollbar {
        width: 10px;
        }

        ::-webkit-scrollbar:horizontal {
        height: 10px;
        }

        ::-webkit-scrollbar-thumb {
        background-color: #6366f1;
        border-radius: 6px;
        }

        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            opacity: 0;
        }

        .page-loading.active>.page-loading-inner {
            opacity: 1;
        }

        .page-loading-inner>span {
            display: block;
            font-size: 1rem;
            font-weight: normal;
            color: #9397ad;
        }

        .dark-mode .page-loading-inner>span {
            color: #fff;
            opacity: .6;
        }

        .page-spinner {
            display: inline-block;
            width: 2.75rem;
            height: 2.75rem;
            margin-bottom: .75rem;
            vertical-align: text-bottom;
            border: .15em solid #b4b7c9;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner .75s linear infinite;
            animation: spinner .75s linear infinite;
        }

        .dark-mode .page-spinner {
            border-color: rgba(255, 255, 255, .4);
            border-right-color: transparent;
        }

        @-webkit-keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
    

    <!-- Theme mode -->
    <script>
        let mode = window.localStorage.getItem('mode'),
            root = document.getElementsByTagName('html')[0];
        if (mode !== null && mode === 'dark') {
            root.classList.add('dark-mode');
        } else {
            root.classList.remove('dark-mode');
        }
    </script>

    <!-- Page loading scripts -->
    <script>
        (function () {
            window.onload = function () {
                const preloader = document.querySelector('.page-loading');
                preloader.classList.remove('active');
                setTimeout(function () {
                    preloader.remove();
                }, 1000);
            };
        })();
    </script>
</head>


<!-- Body -->
<?php
session_start();
if (isset($_GET['login']) && $_GET['login'] == "success") { ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Toastify({
                text: "<?= $_SESSION['message']; ?>",
                duration: 9000,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "<?= $_SESSION['messageColor']; ?>",
                stopOnFocus: true
            }).showToast();
        });
    </script>
    <?php
    unset($_SESSION['message']); unset($_SESSION['messageColor']);
}
?>

<body>

    <!-- Page loading spinner -->
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div><span>Cargando...</span>
        </div>
    </div>


    <!-- Page wrapper for sticky footer -->
    <!-- Wraps everything except footer to push footer to the bottom of the page if there is little content -->
    <main class="page-wrapper">


        <!-- Navbar -->
        <header class="header navbar navbar-expand-lg bg-light navbar-sticky">
            <div class="container px-3">
                <a href="?p=home" class="navbar-brand pe-3">
                    <div id="logo" alt="iRaffle TV"></div>
                    iRaffle TV
                </a>
                <div id="navbarNav" class="offcanvas offcanvas-end">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            $queryFutbol = mysqli_query($conn, "SELECT id FROM partidos WHERE tipo='football'");
                            $countFutbol = mysqli_num_rows($queryFutbol);
                            if ($countFutbol > 0):
                                ?>
                                <li class="nav-item">
                                    <a href="?p=eventos&tipo=football" class="nav-link
                                <?= ($_GET['tipo'] == 'football') ? 'active' : ''; ?>">Fútbol</a>
                                </li>
                            <?php endif;
                            $queryBasket = mysqli_query($conn, "SELECT id FROM partidos WHERE tipo='basketball'");
                            $countBasket = mysqli_num_rows($queryBasket);
                            if ($countBasket > 0):
                                ?>
                                <li class="nav-item">
                                    <a href="?p=eventos&tipo=basketball" class="nav-link
                                <?= ($_GET['tipo'] == 'basketball') ? 'active' : ''; ?>">Basketball</a>
                                </li>
                            <?php endif;
                            $queryNFL = mysqli_query($conn, "SELECT id FROM partidos WHERE tipo='american-football'");
                            $countNFL = mysqli_num_rows($queryNFL);
                            if ($countNFL > 0):
                                ?>
                                <li class="nav-item">
                                    <a href="?p=eventos&tipo=american-football&liga=9464" class="nav-link
                                <?= ($_GET['tipo'] == 'american-football') ? 'active' : ''; ?>">NFL</a>
                                </li>
                            <?php endif;
                            $queryMLB = mysqli_query($conn, "SELECT id FROM partidos WHERE tipo='baseball'");
                            $countMLB = mysqli_num_rows($queryMLB);
                            if ($countMLB > 0):
                                ?>
                                <li class="nav-item">
                                    <a href="?p=eventos&tipo=baseball&liga=11205" class="nav-link
                                <?= ($_GET['tipo'] == 'baseball') ? 'active' : ''; ?>">MLB</a>
                                </li>
                            <?php endif;
                            $queryTenis = mysqli_query($conn, "SELECT id FROM partidos WHERE tipo='tennis'");
                            $countTenis = mysqli_num_rows($queryTenis);
                            if ($countTenis > 0):
                                ?>
                                <li class="nav-item">
                                    <a href="?p=eventos&tipo=tennis" class="nav-link
                                <?= ($_GET['tipo'] == 'tennis') ? 'active' : ''; ?>">Tenis</a>
                                </li>
                            <?php endif;
                            $queryNHL = mysqli_query($conn, "SELECT id FROM partidos WHERE tipo='ice-hockey'");
                            $countNHL = mysqli_num_rows($queryNHL);
                            if ($countNHL > 0):
                                ?>
                                <li class="nav-item">
                                    <a href="?p=eventos&tipo=ice-hockey&liga=234" class="nav-link
                                <?= ($_GET['tipo'] == 'ice-hockey') ? 'active' : ''; ?>">NHL</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="?p=motor" class="nav-link
                                <?= ($_GET['p'] == 'motor') ? 'active' : ''; ?>">Motor</a>
                            </li>
                            <li class="nav-item">
                                <a href="?p=tv" class="nav-link
                                <?= ($_GET['p'] == 'tv') ? 'active' : ''; ?>">TV</a>
                            </li>
                            <li class="nav-item">
                                <a href="?p=radio" class="nav-link
                                <?= ($_GET['p'] == 'radio') ? 'active' : ''; ?>">Radio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle
                                <?= ($_GET['p'] == 'star') ? 'active' : ''; ?>
                                <?= ($_GET['p'] == 'vix') ? 'active' : ''; ?>" data-bs-toggle="dropdown"
                                    aria-current="page">Exclusivos</a>
                                <ul class="dropdown-menu">
                                    <li><a href="?p=star" class="dropdown-item
                                    <?= ($_GET['p'] == 'star') ? 'active' : ''; ?>">Star+</a></li>
                                    <li><a href="?p=vix" class="dropdown-item
                                    <?= ($_GET['p'] == 'vix') ? 'active' : ''; ?>">Vix+</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4" data-bs-toggle="mode">
                    <input type="checkbox" class="form-check-input" id="theme-mode">
                    <label class="form-check-label d-none d-sm-block" for="theme-mode"><i
                            class="bx bx-sun fs-5 lh-1 me-1"></i></label>
                    <label class="form-check-label d-none d-sm-block" for="theme-mode"><i
                            class="bx bx-moon fs-5 lh-1 me-1"></i></label>
                </div>
                <a href="<?= (isset($_SESSION['usuario_id'])) ? '?p=cuenta' : '?p=login'; ?>"
                    class="btn btn-primary btn-sm fs-sm rounded d-none d-lg-inline-flex" rel="noopener">
                    <i class="bx bx-user fs-5 lh-1 me-1"></i>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </header>