<div id="toast-container" class="position-fixed bottom-0 end-0 p-3">
</div>
<?php
session_start();
include('../conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["canal_id"]) && isset($_POST["voto"]) && isset($_SESSION["usuario_id"])) {
    // Obtener datos de la solicitud AJAX
    $usuarioId = $_SESSION['usuario_id'];
    $canalAlt = $_POST['canal_id'];
    $voto = $_POST['voto'];

    // Verificar si el usuario ha votado para este canal antes
    $sqlCheckVote = "SELECT voto FROM votos WHERE usuario_id = $usuarioId AND canal_id = $canalAlt";
    $resultCheckVote = $conn->query($sqlCheckVote);

    if ($resultCheckVote->num_rows > 0) {
        // El usuario ha votado antes para este canal
        $row = $resultCheckVote->fetch_assoc();
        $votoAnterior = $row['voto'];

        if ($voto == $votoAnterior) {
            // El usuario quiere deshacer su voto, eliminar el voto de la base de datos
            $sqlDeleteVote = "DELETE FROM votos WHERE usuario_id = $usuarioId AND canal_id = $canalAlt";
            if ($conn->query($sqlDeleteVote) === TRUE) {
                // Voto eliminado OK
            } else {
                echo "Error al eliminar el voto: " . $conn->error;
            }
        } else {
            // El usuario quiere cambiar su voto, actualizar el voto en la base de datos
            $sqlUpdateVote = "UPDATE votos SET voto = '$voto' WHERE usuario_id = $usuarioId AND canal_id = $canalAlt";
            if ($conn->query($sqlUpdateVote) === TRUE) {
                // Voto actualizado OK
            } else {
                echo "Error al actualizar el voto: " . $conn->error;
            }
        }
    } else {
        // El usuario no ha votado antes para este canal, insertar el voto en la base de datos
        $sqlInsertVote = "INSERT INTO votos (usuario_id, canal_id, voto) VALUES ($usuarioId, $canalAlt, '$voto')";
        if ($conn->query($sqlInsertVote) === TRUE) {
            // Voto insertado OK
        } else {
            echo "Error al registrar el voto: " . $conn->error;
        }
    }
}
?>