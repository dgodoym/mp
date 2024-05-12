<?php
// Reproductor
if (isset($_GET['source'])) {
    include('play.php');
} else { ?>
    <section class="container text-center pt-5 mt-2 mt-md-4 mt-lg-5">
        <h2 class="h1 d-md-inline-block position-relative mb-md-5 mb-sm-4 text-sm-start text-center">
            Emisoras de Radio
            <!-- Arrow shape -->
            <svg class="d-md-block d-none position-absolute top-0 ms-4 ps-1" style="left: 100%;"
                xmlns="http://www.w3.org/2000/svg" width="65" height="68" fill="#6366f1">
                <path
                    d="M53.9527 51.0012c8.396-10.5668 2.0302-26.0134-11.7481-26.7511-.6899-.0646-1.4612.0015-2.1258.0431.1243 9.0462-4.1714 18.8896-11.5618 21.3814-6.6695 2.2133-10.3337-4.2224-7.5813-9.676 3.2966-6.4755 9.103-11.8504 16.1678-13.8189-.5654-5.6953-3.3436-10.7672-9.485-12.48517C17.2678 6.8204 6.49364 16.3681 4.98841 26.127c-.09276 1.0297-1.68569.9497-1.59293-.0801C3.98732 12.9139 19.7395 2.55212 31.9628 8.5787c4.7253 2.3813 7.2649 7.3963 7.9368 13.067 7.4237-.9311 14.5154 3.3683 18.3422 9.5422 4.3988 7.1623 2.3584 15.1401-2.6322 21.1108-.7826.9653-2.3331-.3572-1.6569-1.2975zM26.7754 32.1845c-1.9411 2.2411-4.076 5.0872-4.3542 8.1764-.3036 2.9829 3.7601 3.0525 5.4905 2.7645 2.1568-.3863 3.7221-2.3164 4.8863-4.0419 2.6228-3.6308 4.3657-9.0752 4.4844-14.2563-4.0808 1.279-7.6514 4.2327-10.507 7.3573zm24.6311 25.592c-.7061-2.9738-1.2243-6.1031-1.1591-9.143.0423-1.242 1.767-1.0805 1.8313.1372.1284 2.435.815 4.8532 1.4764 7.1651l4.1619-1.4098c1.0153-.4586 2.4373-1.5714 3.6544-1.1804.6087.1954.7347.7264.6475 1.3068-.2302 1.3976-2.4683 1.9147-3.5901 2.398-1.8429.7619-3.6293 1.2865-5.5477 1.7298-.6391.1476-1.3233-.3665-1.4746-1.0037z">
                </path>
            </svg>
        </h2>
        <div id="canales" class="row">
            <!-- Filtro de Canales -->
            <form class="input-group">
                <input type="text" placeholder="Buscar un canal..." class="form-control form-control-lg rounded-3">
                <a class="btn btn-icon btn-lg btn-primary rounded-3 ms-3">
                    <i class="bx bx-search"></i>
                </a>
            </form>
            <p class="mb-4">
                El contenido de esta sección ha sido posible gracias al extraordinario trabajo de Marc LaQuay y su proyecto <a href="https://github.com/LaQuay/TDTChannels/tree/master" target="_blank">TDT Channels</a>.
            </p>
            <?php include('inc/componentes/radio.php');  ?>
        </div>
    </section>
<?php } ?>