<style>
.channel-card {
    transition: all 0.6s ease;
}
#channels-container {
    transition: all 0.6s ease;
}
#player-container {
    transition: all 0.6s ease;
}
@media (max-width: 800px) {
    #channels-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
    }

    #channels-container h3 {
        display: none;
    }

    .channel-card {
        margin: 10px;
    }

    .col-6 , .col-sm-3 {
        width: 15%!important;
    }

    #player-container {
        order: -1; /* Mueve el reproductor al principio del flujo flex */
        width: 100%; /* Ocupa el ancho completo del contenedor padre */
        margin-bottom: 20px; /* Espacio entre el reproductor y las tarjetas de canales */
    }
}
</style>
<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<div class="container mt-5">
    <div class="row">
        <div id="channels-container" class="col-md-4">
            <h3>Canales</h3>
            <div class="row">
                <div class="sticky-top col-12">
                    <form class="input-group">
                        <input type="text" placeholder="Buscar un canal..."
                            class="form-control form-control-lg rounded-3">
                        <button class="btn btn-icon btn-lg btn-primary rounded-3 ms-3 dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div id="channelFilter" class="dropdown-menu mx-1" style="">
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="#">Pronto Disponible</a>
                        </div>
                    </form>
                </div>
            </div>
            <div id="channelList" class="row">Cargando canales</div>
        </div>

        <!-- Reproductor de Video -->
        <div id="player-container" class="col-md-8">
            <div class="container sticky-top ms-xl-5 ms-lg-4 ps-xxl-4" style="top: 105px !important;">
                <h3 id="channelName">Reproductor de Video</h3>
                <div class="embed-responsive">
                    <div id="videoPlayer"></div>
                </div>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-8">
                        ANUNCIO
                    </div>
                    <div class="col-4">
                        <select id="channelOptions" class="form-select"></select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span class="hidden" id="playerContainer"></span>
<span class="hidden" id="playerFake"></span>
<script src="assets/js/iptv.js"></script>