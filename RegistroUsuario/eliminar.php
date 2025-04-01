<?php
$servername = 'dbregmex:3306';
$username = 'root';
$password = 'ema';
$dbname = 'dbregmex';

$conn = new mysqli($servername, $username, $password, $dbname);


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!$conn) {
        die("Error de conexión a la base de datos");
    }

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: modificaciones.php?eliminado=true");
            exit();
        } else {
            header("Location: modificaciones.php?eliminado=false");
            exit();
        }
    } else {
        die("Error al preparar la consulta: " . $conn->error);
    }
} else {
    die("ID no especificado");
}
?>
