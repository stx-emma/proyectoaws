<?php
$servername = 'dbregmex:3306';
$username = 'root';
$password = 'ema';
$dbname = 'dbregmex';

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}
$usuario = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "No se encontró el usuario.";
        exit();
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}

$conn->close();
echo json_encode($usuario);
?>
