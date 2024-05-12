<?php
// Eliminar cuenta
if (isset($_GET['borrar-cuenta'])) {
    // Verificar si se marcó el checkbox

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];

    // Validar y actualizar los datos del usuario en la base de datos
    $sql = "UPDATE usuarios SET email='$email', nombre='$nombre', bio='$bio' WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result) {
        // Redirigir al usuario después de guardar los cambios
        header("Location: ?p=cuenta");
        echo "Se ha actualizado la información exitosamente";
    } else {
        // El método de solicitud no es POST, redirigir al usuario a alguna página de error
        header("Location: ?p=cuenta");
        echo "Ha ocurrido un error actualizado la información";
    }
}
?>
<!-- Account details -->
<div class="col-md-8 offset-lg-1">
    <div class="ps-md-3 ps-lg-0">
        <h1 class="h2 pt-xl-1 pb-3">Detalles de tu Cuenta</h1>
        <?php if (isset($_SESSION['message'])) { ?>
            <h5 class="text-center">
                <span class="badge bg-faded-danger text-danger">
                    <?= $_SESSION['message']; ?>
                </span>
            </h5>
        <?php }
        unset($_SESSION['message']); ?>
        <!-- Basic info -->
        <h2 class="h5 text-primary mb-4">Información Básica</h2>
        <form class="needs-validation border-bottom pb-3 pb-lg-4" novalidate="" method="POST">
            <div class="row pb-2">
                <div class="col-sm-6 mb-4">
                    <label for="name" class="form-label fs-base">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg" value="<?= $nombre ?>" required="">
                    <div class="invalid-feedback">¡Por favor introduce tu nombre!</div>
                </div>
                <div class="col-sm-6 mb-4">
                    <label for="email" class="form-label fs-base">Dirección de Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?= $email ?>" required="">
                    <div class="invalid-feedback">¡Por favor introduce un correo válido!</div>
                </div>
                <div class="col-12 mb-4">
                    <label for="bio" class="form-label fs-base">Bio <small class="text-muted">(opcional)</small></label>
                    <textarea id="bio" name="bio" class="form-control form-control-lg" rows="4" placeholder="<?= ($bio !== null ) ? $bio : 'Cuéntanos un poco acerca de ti...'; ?>"></textarea>
                </div>
            </div>
            <div class="d-flex mb-3">
                <button type="reset" class="btn btn-secondary me-3">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
        <!-- Borrar Cuenta
        <h2 class="h5 text-primary pt-1 pt-lg-3 mt-4">Borrar Cuenta</h2>
        <p>Cuando eliminas tu cuenta, tu perfil público se desactiva inmediatamente. Si cambias de opinión, tu cuenta se
            podrá recuperar antes de que pasen 30 días, simplemente inicia sesión con tu correo electrónico y contraseña
            y tu cuenta se reactivará automáticamente.</p>
        <div class="form-check mb-4">
            <input type="checkbox" id="delete-account" name="delete-account" class="form-check-input">
            <label for="delete-account" class="form-check-label fs-base">Confirmo que quiero eliminar mi cuenta</label>
        </div>
        <a href="?p=cuenta&borrar-cuenta" class="btn btn-danger" id="borrar-usuario" name="borrar-usuario">Borrar</a>
        -->
    </div>
</div>