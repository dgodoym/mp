<!-- Sidebar (User info + Account menu) -->
<aside class="col-lg-3 col-md-4 border-end pb-5 mt-n5">
    <div class="position-sticky top-0">
        <div class="text-center pt-5">
            <div class="d-table position-relative mx-auto mt-2 mt-lg-4 pt-5 mb-3">
                <img src="assets/img/avatar/<?= rand(1, 41) ?>.jpg" class="d-block rounded-circle" width="120" alt="<?=$nombre?>">
                <button type="button"
                    class="btn btn-icon btn-light bg-white btn-sm border rounded-circle shadow-sm position-absolute bottom-0 end-0 mt-4"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Change picture"
                    data-bs-original-title="Change picture">
                    <i class="bx bx-refresh"></i>
                </button>
            </div>
            <h2 class="h5 mb-1"><?=$nombre?></h2>
            <p class="mb-3 pb-3"><?=$email?></p>
            <button type="button" class="btn btn-secondary w-100 d-md-none mt-n2 mb-3" data-bs-toggle="collapse"
                data-bs-target="#account-menu">
                <i class="bx bxs-user-detail fs-xl me-2"></i>
                Menú de Cuenta
                <i class="bx bx-chevron-down fs-lg ms-1"></i>
            </button>
            <div id="account-menu" class="list-group list-group-flush collapse d-md-block">
                <a href="?p=cuenta"
                    class="list-group-item list-group-item-action d-flex align-items-center <?= ($_GET['p'] == 'cuenta' && (!isset($_GET['s']))) ? 'active' : ''; ?>">
                    <i class="bx bx-cog fs-xl opacity-60 me-2"></i>
                    Detalles de Cuenta
                </a>
                <a href="?p=cuenta&s=seguridad"
                    class="list-group-item list-group-item-action d-flex align-items-center <?= ($_GET['p'] == 'cuenta' && ($_GET['s'] == "seguridad" )) ? 'active' : ''; ?>">
                    <i class="bx bx-lock-alt fs-xl opacity-60 me-2"></i>
                    Seguridad
                </a>
                <a href="?p=cuenta&s=guardados"
                    class="list-group-item list-group-item-action d-flex align-items-center <?= ($_GET['p'] == 'cuenta' && ($_GET['s'] == "guardados" )) ? 'active' : ''; ?>">
                    <i class="bx bx-bookmark fs-xl opacity-60 me-2"></i>
                    Elementos Guardados
                </a>
                <a href="?p=login&do=logout" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="bx bx-log-out fs-xl opacity-60 me-2"></i>
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</aside>