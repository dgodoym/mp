<div id="toast-container" class="position-fixed bottom-0 end-0 p-3">
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos ID
    $usuario_id = $_SESSION['usuario_id'];
    // Datos POST
    $contrasena_actual = $_POST["actual-password"];
    $nueva_contrasena = $_POST["nueva-password"];
    $confirmar_nueva_contrasena = $_POST["confirmar-nueva-password"];

    // Consulta SQL para obtener el usuario por su correo electrónico
    $sql = "SELECT * FROM usuarios WHERE id='$usuario_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        // Verificar la contraseña solo si se encuentra el usuario con el ID
        if (password_verify($contrasena_actual, $usuario['contrasena'])) {
            if ($nueva_contrasena === $confirmar_nueva_contrasena) {
                // Hash de la contraseña
                $contrasenaHash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET contrasena='$contrasenaHash' WHERE id='$usuario_id'";
                $result = $conn->query($sql);
                if ($result) { ?>
                    <script>
                        // Función para mostrar el toast
                        function mostrarToast(mensaje) {
                            // Crear el elemento de toast
                            var toast = document.createElement('div');
                            toast.className = 'toast fade show';
                            toast.setAttribute('role', 'alert');
                            toast.setAttribute('aria-live', 'assertive');
                            toast.setAttribute('aria-atomic', 'true');
                            toast.setAttribute('data-bs-autohide', 'true');

                            // Contenido del toast
                            toast.innerHTML = `
                                                <!-- Success toast -->
                                                <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                                <div class="toast-header bg-success text-white">
                                                    <i class="bx bx-check-circle fs-lg me-2"></i>
                                                    <span class="me-auto">Éxito</span>
                                                    <button class="btn-close btn-close-white ms-2 mb-1" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                                <div class="toast-body text-success">${mensaje}</div>
                                                </div>`;

                            // Agregar el toast al contenedor
                            document.getElementById('toast-container').appendChild(toast);

                            // Mostrar el toast
                            var bsToast = new bootstrap.Toast(toast);
                            bsToast.show();
                        }
                        // Ejemplo de uso: mostrar el toast cuando el usuario ha cambiado su contraseña
                        mostrarToast('¡Se ha modificado la contraseña de tu perfil!');

                    </script>
                    <?php
                }
            }
        } else { ?>
            <script>
                // Función para mostrar el toast
                function mostrarToast(mensaje) {
                    // Crear el elemento de toast
                    var toast = document.createElement('div');
                    toast.className = 'toast fade show';
                    toast.setAttribute('role', 'alert');
                    toast.setAttribute('aria-live', 'assertive');
                    toast.setAttribute('aria-atomic', 'true');
                    toast.setAttribute('data-bs-autohide', 'true');

                    // Contenido del toast
                    toast.innerHTML = `
                                        <!-- Danger toast -->
                                        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                        <div class="toast-header bg-danger text-white">
                                            <i class="bx bx-check-circle fs-lg me-2"></i>
                                            <span class="me-auto">Error</span>
                                            <button class="btn-close btn-close-white ms-2 mb-1" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body text-danger">${mensaje}</div>
                                        </div>`;

                    // Agregar el toast al contenedor
                    document.getElementById('toast-container').appendChild(toast);

                    // Mostrar el toast
                    var bsToast = new bootstrap.Toast(toast);
                    bsToast.show();
                }
                // Ejemplo de uso: mostrar el toast cuando el usuario ha cambiado su contraseña
                mostrarToast('Hay un problema con tus contraseñas');

            </script>
        <?php }
    }
}
?>
<!-- Account details -->
<div class="col-md-8 offset-lg-1">
    <div class="ps-md-3 ps-lg-0">
        <h1 class="h2 pt-xl-1 pb-3">Seguridad</h1>
        <?php if (isset($_SESSION['message'])) { ?>
            <h5 class="text-center">
                <span class="badge bg-faded-danger text-danger">
                    <?= $_SESSION['message']; ?>
                </span>
            </h5>
        <?php }
        unset($_SESSION['message']); ?>
        <!-- Basic info -->
        <h2 class="h5 text-primary mb-4">Contraseña</h2>
        <form class="needs-validation border-bottom pb-3 pb-lg-4" novalidate="" method="POST">
            <div class="row">
                <div class="col-sm-6 mb-4">
                    <label for="actual-password" class="form-label fs-base">Contraseña actual</label>
                    <div class="password-toggle">
                        <input type="password" id="actual-password" name="actual-password"
                            class="form-control form-control-lg" required="">
                        <label class="password-toggle-btn" aria-label="Show/hide password">
                            <input class="password-toggle-check" type="checkbox">
                            <span class="password-toggle-indicator"></span>
                        </label>
                        <div class="invalid-tooltip position-absolute top-100 start-0">¡Contraseña incorrecta!</div>
                    </div>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-sm-6 mb-4">
                    <label for="nueva-password" class="form-label fs-base">Nueva contraseña</label>
                    <div class="password-toggle">
                        <input type="password" id="nueva-password" name="nueva-password"
                            class="form-control form-control-lg" required="">
                        <label class="password-toggle-btn" aria-label="Show/hide password">
                            <input class="password-toggle-check" type="checkbox">
                            <span class="password-toggle-indicator"></span>
                        </label>
                        <div class="invalid-tooltip position-absolute top-100 start-0">¡Contraseña incorrecta!</div>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <label for="confirmar-nueva-password" class="form-label fs-base">Confirmar nueva contraseña</label>
                    <div class="password-toggle">
                        <input type="password" id="confirmar-nueva-password" name="confirmar-nueva-password"
                            class="form-control form-control-lg" required="">
                        <label class="password-toggle-btn" aria-label="Show/hide password">
                            <input class="password-toggle-check" type="checkbox">
                            <span class="password-toggle-indicator"></span>
                        </label>
                        <div class="invalid-tooltip position-absolute top-100 start-0">¡Contraseña incorrecta!</div>
                    </div>
                </div>
            </div>
            <div class="d-flex mb-3">
                <button type="reset" class="btn btn-secondary me-3">Cancel</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        <!-- Sesiones -->
        <h2 class="h5 text-primary pt-1 pt-lg-3 mt-4">Tus sesiones (Coming!)</h2>
        <p class="pb-3 mb-3">Esta es una lista de dispositivos que han iniciado sesión en tu cuenta. Elimina cualquier
            sesión que no reconozcas.</p>
        <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-start me-3">
                    <div class="bg-secondary rounded-1 p-2">
                        <i class="bx bx-desktop fs-xl text-primary d-block"></i>
                    </div>
                    <div class="ps-3">
                        <div class="fw-medium text-nav mb-1">Mac – New York, USA</div>
                        <span class="d-inline-block fs-sm text-muted border-end pe-2 me-2">Chrome</span>
                        <span class="badge bg-success shadow-success">Active now</span>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-secondary px-3 px-sm-4">
                    <i class="bx bx-x fs-xl ms-sm-n1 me-sm-1"></i>
                    <span class="d-none d-sm-inline">Remove</span>
                </button>
            </li>
            <li class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-start me-3">
                    <div class="bg-secondary rounded-1 p-2">
                        <i class="bx bx-mobile fs-xl text-primary d-block"></i>
                    </div>
                    <div class="ps-3">
                        <div class="fw-medium text-nav mb-1">Iphone 12 – New York, USA</div>
                        <span class="d-inline-block fs-sm text-muted border-end pe-2 me-2">Silicon App</span>
                        <span class="d-inline-block fs-sm text-muted">20 hours ago</span>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-secondary px-3 px-sm-4">
                    <i class="bx bx-x fs-xl ms-sm-n1 me-sm-1"></i>
                    <span class="d-none d-sm-inline">Remove</span>
                </button>
            </li>
            <li class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-start me-3">
                    <div class="bg-secondary rounded-1 p-2">
                        <i class="bx bx-desktop fs-xl text-primary d-block"></i>
                    </div>
                    <div class="ps-3">
                        <div class="fw-medium text-nav mb-1">Windows 10.1 – New York, USA</div>
                        <span class="d-inline-block fs-sm text-muted border-end pe-2 me-2">Chrome</span>
                        <span class="d-inline-block fs-sm text-muted">November 15 at 8:42 am</span>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-secondary px-3 px-sm-4">
                    <i class="bx bx-x fs-xl ms-sm-n1 me-sm-1"></i>
                    <span class="d-none d-sm-inline">Remove</span>
                </button>
            </li>
        </ul>
    </div>
</div>