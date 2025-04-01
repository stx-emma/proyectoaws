<?php
// Conexión a la base de datos
$servername = 'dbregmex:3306';
$username = 'root';
$password = 'ema';
$dbname = 'dbregmex'; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Verificar si los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $grado = $_POST['grado'];
    $escolaridad = $_POST['escolaridad'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $fecha_asistencia = date('Y-m-d H:i:s');
    $bandera_asistencia = "0";
    
    // Insertar los datos en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header('Location: registro.php?success=false');
    } else {
        // Crear los datos para el QR
        $qrData = "Nombre: $nombre\nApellido Paterno: $apellido_p\nApellido Materno: $apellido_m\nGrado: $grado\nEscolaridad: $escolaridad\nEmail: $email\nTipo: $tipo\nFecha de Asistencia: $fecha_asistencia\nBandera de Asistencia: $bandera_asistencia";
        
        // URL de la API para generar el QR
        $qrApiUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($qrData) . '&size=200x200';
        
        // Generar una ruta para guardar el QR en el servidor
        $qrDirectory = 'images/QR';
        
        // Generar un nombre único para la imagen QR
        $qrImageName = uniqid('qr_', true) . '.png';
        $qrImagePath = $qrDirectory . $qrImageName;

        // Descargar la imagen del QR desde la URL de la API y guardarla en el servidor
        //file_put_contents($qrImagePath, file_get_contents($qrApiUrl));

        // Guardar la ruta del QR en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellido_p, apellido_m, grado, escolaridad, email, tipo, fecha_asistencia, bandera_asistencia, qr) 
                VALUES ('$nombre', '$apellido_p', '$apellido_m', '$grado', '$escolaridad', '$email', '$tipo', '$fecha_asistencia', '$bandera_asistencia', '$qrImagePath')";
        
        //if ($conn->query($sql) === TRUE) {
            // Redirigir a registro.php con el URL del QR generado
            //header('Location: registro.php?qrUrl=' . urlencode($qrImagePath) . '&success=true');
       // } else {
          //  echo 'Error: ' . $sql . '<br>' . $conn->error;
        //}
        if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
    exit(); 
} else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
}

    }
}
$conn->close();
?>
