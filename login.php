<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
session_start();
// Código para cerrar sesión
if ($_GET['do'] == "logout") {
    $_SESSION['message'] = "Has cerrado sesión satisfactoriamente. Esperamos verte pronto nuevamente";
    $_SESSION['messageColor'] = "#4044ee";
    // Destruir todas las variables de sesión
    session_destroy();
    header("Location: ?p=home&login=success");
    // Eliminar las cookies de usuario
    setcookie("usuario_id", "", time() - 3600, "/");
    setcookie("usuario_rol", "", time() - 3600, "/");
    exit();

}
// Redirigir si ya hay sesión
if (isset($_SESSION['usuario_id'])) {
    $_SESSION['message'] = "Ya has iniciado sesión previamente";
    header("Location: ?p=cuenta");
}
?>
<section class="position-relative h-100 pt-5 pb-4">
    <?php if ($_GET['do'] == "registro") { ?>
        <!-- Sign up form -->
        <div class="container d-flex flex-wrap justify-content-center justify-content-xl-start  pt-5">
            <div class="w-100 align-self-end pt-1 pt-md-4 pb-4" style="max-width: 526px;">
                <h1 class="text-center text-xl-start">Crear Cuenta</h1>
                <?php if (isset($_SESSION['message'])) { ?>
                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Toastify({
                            text: "<?= $_SESSION['message']; ?>",
                            duration: 9000,
                            close: true,
                            gravity: "bottom",
                            position: "left",
                            backgroundColor: "<?= $_SESSION['messageColor']; ?>",
                            stopOnFocus: true
                        }).showToast();
                    });
                    </script>
                <?php }
                unset($_SESSION['message']); ?>
                <p class="text-center text-xl-start pb-3 mb-3">¿Ya tienes una? <a href="?p=login">Iniciar
                        sesión.</a></p>
                <form action="inc/usuario/registro.php" class="needs-validation" novalidate="" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="position-relative mb-4">
                                <label for="name" class="form-label fs-base">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" required="">
                                <div class="invalid-feedback position-absolute start-0 top-100">¡Por favor introduce tu
                                    nombre!
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="position-relative mb-4">
                                <label for="email" class="form-label fs-base">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg"
                                    required="">
                                <div class="invalid-feedback position-absolute start-0 top-100">¡Por favor introduce un
                                    correo válido!</div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <label for="password" class="form-label fs-base">Contraseña</label>
                            <div class="password-toggle">
                                <input type="password" id="password" name="password" class="form-control form-control-lg"
                                    required="">
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                                <div class="invalid-feedback position-absolute start-0 top-100">¡Por favor crea una
                                    contraseña segura!
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <label for="password-confirm" class="form-label fs-base">Confirmar contraseña</label>
                            <div class="password-toggle">
                                <input type="password" id="password-confirm" name="password-confirm"
                                    class="form-control form-control-lg" required="">
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                                <div class="invalid-feedback position-absolute start-0 top-100">¡Debes verificar tu
                                    contraseña!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary shadow-primary btn-lg w-100">Registrarse</button>
                </form>
                <hr class="my-4">
            </div>
        </div>
    <?php } else { ?>
        <!-- Log in form -->
        <div class="container d-flex flex-wrap justify-content-center justify-content-xl-start  pt-5">
            <div class="w-100 align-self-end pt-1 pt-md-4 pb-4" style="max-width: 526px;">
                <h1 class="text-center text-xl-start">Bienvenido de nuevo</h1>
                <?php if (isset($_SESSION['message'])) { ?>
                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Toastify({
                            text: "<?= $_SESSION['message']; ?>",
                            duration: 9000,
                            close: true,
                            gravity: "bottom",
                            position: "left",
                            backgroundColor: "<?= $_SESSION['messageColor']; ?>",
                            stopOnFocus: true
                        }).showToast();
                    });
                    </script>
                <?php }
                unset($_SESSION['message']); ?>
                <p class="text-center text-xl-start pb-3 mb-3">¿Todavía no tienes cuenta? <a
                        href="?p=login&do=registro">Registrarse.</a></p>
                <form action="inc/usuario/login.php" class="needs-validation" novalidate="" method="POST">
                    <div class="position-relative mb-4">
                        <label for="email" class="form-label fs-base">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" required="">
                        <div class="invalid-feedback position-absolute start-0 top-100">Please enter a valid email address!
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fs-base">Password</label>
                        <div class="password-toggle">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                required="">
                            <label class="password-toggle-btn" aria-label="Show/hide password">
                                <input class="password-toggle-check" type="checkbox">
                                <span class="password-toggle-indicator"></span>
                            </label>
                            <div class="invalid-feedback position-absolute start-0 top-100">Please enter your password!
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label fs-base">Remember me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary shadow-primary btn-lg w-100">Sign in</button>
                </form>
                <hr class="my-4">
            </div>
        </div>
    <?php } ?>

    <!-- Background -->
    <div class="position-absolute top-0 end-0 w-50 h-100 bg-position-center bg-repeat-0 bg-size-cover d-none d-xl-block"
        style="background-image: url(assets/img/account/brady.jpg);"></div>
</section>