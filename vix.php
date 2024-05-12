<section class="container">
    <!-- Page title + Filters -->
    <div class="d-lg-flex align-items-center justify-content-between py-4 mt-lg-2">
        <h1 class="me-3">Vix+</h1>
        <div class="d-md-flex mb-3">
            <div class="position-relative" style="min-width: 300px;">
                <input id="filtroInput" type="text" class="form-control pe-5" placeholder="Buscar evento">
                <i class="bx bx-search text-nav fs-lg position-absolute top-50 end-0 translate-middle-y me-3"></i>
            </div>
        </div>
    </div>
    <!-- Events grid -->
    <p><em>Los eventos pueden tardar unos segundos en cargar, por favor espera un poco.</em></p>
    <div id="eventos" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 mt-n2 mt-sm-0">
    </div>
    <script src="inc/eventos/vix.js"></script>
</section>