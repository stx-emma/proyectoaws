<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificaciones</title>
    <link rel="stylesheet" href="registro/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="registro/registro.css">
    <script src="registro/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="registro/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2 class="titulo">Modificaciones</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="actualizar.php" method="POST" onsubmit="mostrarLoader()">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <label for="nombre" class="label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                        
                        <label for="apellidoP" class="label">Apellido Paterno</label>
                        <input type="text" name="apellido_p" id="apellidoP" class="form-control" required>
                        
                        <label for="apellidoM" class="label">Apellido Materno</label>
                        <input type="text" name="apellido_m" id="apellidoM" class="form-control" required>
                        
                        <label for="grado" class="label">Grado Académico</label>
                        <select name="grado" id="grado" class="form-select" required>
                            <option selected>Selecciona una opción</option>
                            <option value="Ciudadano">Ciudadano</option>
                            <option value="Lic">Lic.</option>
                            <option value="Ing">Ing.</option>
                            <option value="Dr">Dr.</option>
                        </select>
                        
                        <label for="escolaridad" class="label">Escolaridad</label>
                        <select name="escolaridad" id="escolaridad" class="form-select" required>
                            <option selected>Selecciona una opción</option>
                            <option value="edu_b">Educación Básica</option>
                            <option value="nivel_m">Nivel Medio Superior</option>
                            <option value="nivel_s">Nivel Superior</option>
                        </select>
                        
                        <label for="email" class="label">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success mt-3 me-2">Actualizar</button>
                        <button type="button" class="btn btn-danger mt-3" onclick="confirmarEliminacion(<?php echo $id; ?>)">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
function mostrarLoader() {
    document.getElementById('loader').style.display = 'block';
}

function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'eliminar.php?id=' + id;
        }
    });
}

$(document).ready(function() {
    var userId = "<?php echo $id; ?>";
    if (userId) {
        $.ajax({
            url: 'consultar_usuario.php',
            method: 'GET',
            data: { id: userId },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $('#nombre').val(data.nombre);
                    $('#apellidoP').val(data.apellido_p);
                    $('#apellidoM').val(data.apellido_m);
                    $('#grado').val(data.grado);
                    $('#escolaridad').val(data.escolaridad);
                    $('#email').val(data.email);
                }
            },
            error: function() {
                alert('Error al obtener los datos del usuario');
            }
        });
    }

    <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Registro actualizado exitosamente',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'index.php';
        });
    <?php elseif (isset($_GET['success']) && $_GET['success'] == 'false'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error al actualizar el registro',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'index.php';
        });
    <?php endif; ?>

    <?php if (isset($_GET['eliminado']) && $_GET['eliminado'] == 'true'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Usuario eliminado exitosamente',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'index.php';
        });
    <?php elseif (isset($_GET['eliminado']) && $_GET['eliminado'] == 'false'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error al eliminar el usuario',
            showConfirmButton: false,
            timer: 1500
        });
    <?php endif; ?>
});
</script>

</body>
</html>
