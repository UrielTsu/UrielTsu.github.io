<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "proyecto1";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_errno) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
$pass = $_POST['pass'];

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuario WHERE nombre = '$nombre'";
$result = $conn->query($sql);

$mensaje = ""; // Variable para guardar el mensaje

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($pass == $row['pass']) {
        session_start();
        $_SESSION['user'] = $nombre;
        header("Location: crear.php");
        exit;
    } else {
        $mensaje = "<div class='alert alert-danger text-center' role='alert'>
                         Sáquese, no se sabe su contraseña viejo baboso, ¡mejor póngase a jalar!
                    </div>";
    }
} else {
    $mensaje = "<div class='alert alert-warning text-center' role='alert'>
                    Ese no es tu usario wey, te doy otro chance de que lo pongas bien, dale al botón de acá abajo 
                </div>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Mostrar el mensaje si existe -->
    <?php if (!empty($mensaje)) echo $mensaje; ?>

    <div class="text-center">
        <a href="login.php" class="btn btn-primary">Regresar al Login</a>
    </div>
</div>
</body>
</html>

