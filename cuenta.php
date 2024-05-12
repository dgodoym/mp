<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario_id'])) {
    // Obtener el ID de usuario de la sesión actual
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta SQL para obtener los detalles del usuario
    $sql = "SELECT * FROM usuarios WHERE id = '$usuario_id'";
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows == 1) {
        // Obtener los datos del usuario
        $usuario = $result->fetch_assoc();
        $nombre = ucwords($usuario['nombre']);
        $email = $usuario['email'];
        $bio = $usuario['bio'];
        $password = $usuario['contrasena'];

    } else {
        echo "No se encontraron detalles del usuario. Por favor contacta al administrador";
        exit();
    }
} else {
    $_SESSION['message'] = "Por favor inicia sesión para acceder al contenido";
    header("Location: ?p=login");
}
?>
<section class="container pt-5">
    <div class="row">
        <?php include('inc/usuario/sidebar.php'); ?>
        <!-- Detalles de cuenta -->
        <?php
        if (($_GET['s'] == "seguridad" )) {
            include('inc/usuario/seguridad.php');
        } elseif (($_GET['s'] == "guardados" )) {
            include('inc/usuario/guardados.php');
        } else {
            include('inc/usuario/basico.php');
        }
        ?>
    </div>
</section>