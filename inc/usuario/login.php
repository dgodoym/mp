<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include('../conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los índices 'email' y 'password' están definidos en $_POST
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $contrasena = $_POST["password"];

        // Consulta SQL para obtener el usuario por su correo electrónico
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            // Verificar la contraseña solo si se encuentra el usuario con el correo electrónico proporcionado
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol_id'];

                // Crear una cookie para mantener la sesión del usuario durante 7 días (86400 segundos por día * 7 días)
                setcookie("usuario_id", $usuario['id'], time() + (86400 * 7), "/");
                setcookie("usuario_nombre", $usuario['nombre'], time() + (86400 * 7), "/");
                setcookie("usuario_rol", $usuario['rol_id'], time() + (86400 * 7), "/");

                // Redirigir al usuario a otra página después del inicio de sesión
                //header("Location: ../../?p=home&login=success");
                $redirect_url = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : "../../?p=home";
                header("Location: " . $redirect_url . "&login=success");
                $_SESSION['message'] = "¡Hola,". $usuario['nombre'] . " es un gusto tenerte verte de nuevo.";
                $_SESSION['messageColor'] = "#4044ee";
                exit();
            } else {
                // Contraseña incorrecta
                $_SESSION['message'] = "Contraseña incorrecta. Por favor, intenta de nuevo.";
                $_SESSION['messageColor'] = "#ef4444";
                header("Location: ../../?p=login");
                exit();
            }
        } else {
            // Usuario no encontrado por correo electrónico
            $_SESSION['message'] = "Usuario no encontrado. Por favor, verifica tu correo electrónico.";
            $_SESSION['messageColor'] = "#ef4444";
            header("Location: ../../?p=login");
            exit();
        }
    } else {
        // Datos del formulario no recibidos correctamente
        $_SESSION['message'] = "Error al recibir datos del formulario. Por favor contacte con el administrador " . $conn->error;
        $_SESSION['messageColor'] = "#ef4444";
        header("Location: ../../?p=login");
        exit();
    }
}
?>