<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
// Incluir el archivo de conexión a la base de datos
include('../conn.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $contrasena = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $confirmarContrasena = filter_input(INPUT_POST, "password-confirm", FILTER_SANITIZE_STRING);

    // Validar los campos
    if (empty($nombre) || empty($email) || empty($contrasena) || empty($confirmarContrasena)) {
        $_SESSION['message'] = "Al parecer te has olvidado de rellenar algunos campos";
        header("Location: ../../?p=registro");
        exit();
    }

    // Validar coincidencia en contraseña
    if ($contrasena !== $confirmarContrasena) {
        $_SESSION['message'] = "Tus contraseñas no son iguales";
        header("Location: ../../?p=registro");
        exit();
    }

    // Validar que las contraseñas coincidan
    if ($contrasena === $confirmarContrasena) {
        // Hash de la contraseña
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Consulta SQL para insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, contrasena, rol_id) VALUES ('$nombre', '$email', '$contrasenaHash', 2)";

        if ($conn->query($sql) === TRUE) {
            // Iniciar sesión automáticamente después del registro
            $_SESSION['usuario_id'] = $conn->insert_id;
            $_SESSION['usuario_nombre'] = $nombre;
            $_SESSION['usuario_rol'] = 2;
            // Crear una cookie para mantener la sesión del usuario durante 7 días (86400 segundos por día * 7 días)
            setcookie("usuario_id", $conn->insert_id, time() + (86400 * 7), "/", "", true, true);
            setcookie("usuario_nombre", $nombre, time() + (86400 * 7), "/", "", true, true);
            setcookie("usuario_rol", 2, time() + (86400 * 7), "/", "", true, true);


            // Redirigir al usuario a otra página después del registro
            header("Location: ../../?p=home");
            exit();
        } else {
            $_SESSION['message'] = "Error al registrar el usuario: " . $conn->error;
            header("Location: ../../?p=registro");
            exit();
        }
    } else {
        $_SESSION['message'] = "Tus contraseñas no coinciden";
        header("Location: ../../?p=registro");
        exit();
    }
}
?>