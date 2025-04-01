<?php
$servername = 'dbregmex:3306';
$username = 'root';
$password = 'ema';
$dbname = 'dbregmex';

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}


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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $grado = $_POST['grado'];
    $escolaridad = $_POST['escolaridad'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombre='$nombre', apellido_p='$apellido_p', apellido_m='$apellido_m',
            grado='$grado', escolaridad='$escolaridad', email='$email' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: modificaciones.php?success=true");
    } else {
        header("Location: modificaciones.php?success=false");
    }
}

$conn->close();
?>
