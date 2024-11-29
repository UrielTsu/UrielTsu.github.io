<?php
include "masterHead.php";

$server = "localhost";
$user = "root";
$pass = "";
$db = "proyecto1";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_errno) {
    die("Error de conexión: " . $conn->connect_error);
}

$mensaje = "";

// Procesar el borrado si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        $id = intval($_POST['id']);

        $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
        if ($stmt === false) {
            throw new Exception("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $mensaje = "<div class='alert alert-success'>Producto eliminado exitosamente.</div>";
        } else {
            throw new Exception("Error al eliminar el producto: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $mensaje = "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
    }
}

// Obtener todos los productos
$sql = "SELECT * FROM productos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Fondo general */
        body {
            background-color: rgba(40, 19, 19, 0);
            color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        /* Contenedor principal */
        main {
            padding: 20px;
            border-radius: 15px;
            background: linear-gradient(145deg, #1e1e2a, #252536);
            box-shadow: 5px 5px 15px #0d0d14, -5px -5px 15px #29293e;
        }

        h1 {
            color: #b483ff;
        }

        /* Caja de búsqueda */
        .search-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            background: linear-gradient(145deg, #222233, #1a1a28);
            box-shadow: inset 5px 5px 10px #0d0d14, inset -5px -5px 10px #2d2d45;
        }

        .search-box input {
            width: 80%;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #282846;
            color: #ffffff;
        }

        .search-box button {
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            background: linear-gradient(145deg, #a05fff, #6b30ff);
            color: white;
            transition: all 0.3s ease;
        }

        .search-box button:hover {
            background: linear-gradient(145deg, #6b30ff, #a05fff);
        }

        /* Tabla estilizada */
        .table-container {
            padding: 20px;
            border-radius: 15px;
            background: linear-gradient(145deg, #1e1e2a, #252536);
            box-shadow: 5px 5px 15px #0d0d14, -5px -5px 15px #29293e;
        }
        .delete-button {
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            background: linear-gradient(145deg, #a05fff, #6b30ff);
            color: white;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
        }

        .delete-button:hover {
            background: linear-gradient(145deg, #6b30ff, #a05fff);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Efecto active (cuando se presiona) */
        .delete-button:active {
            transform: translateY(0);
            box-shadow: none;
        }


        .delete-button:disabled {
            background: linear-gradient(145deg, #666666, #444444);
            cursor: not-allowed;
            opacity: 0.7;
        }
        table {
            background:  rgba(255, 255, 255, 0.05);
            color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        table thead {
            background: #2c2f37;
            color: #ffffff;
        }

        table tbody tr {
            transition: background 0.3s ease;
        }

        table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.3);
        }
        table img {
            border-radius: 8px;
            object-fit: cover;
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Borrar Productos</h1>
    </div>

    <?php
    // Mostrar el mensaje después del título
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Fecha</th>
                <th>Foto</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                echo "<td>$" . number_format($row['Precio_Compra'], 2) . "</td>";
                echo "<td>$" . number_format($row['Precio_Venta'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['Fecha']) . "</td>";
                echo "<td>";
                if ($row['Foto']) {
                    echo "<img src='uploads/" . htmlspecialchars($row['Foto']) . "' alt='Producto' style='width: 50px; height: 50px; object-fit: cover;'>";
                }
                echo "</td>";
                echo "<td>" . htmlspecialchars($row['Cantidad']) . "</td>";
                echo "<td>";

                echo "<button type='button' class='delete-button' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row['id'] . "'>Eliminar</button>";
                echo "</td>";
                echo "</tr>";

                // Modal de confirmación único
                echo "
                            <div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'>Confirmar eliminación</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                        </div>
                                        <div class='modal-body'>
                                            ¿Está seguro que desea eliminar el producto \"" . htmlspecialchars($row['Nombre']) . "\"?
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                            <form action='" . $_SERVER['PHP_SELF'] . "' method='POST' style='display: inline;'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' class='btn btn-danger'>Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>

<?php
$conn->close();
include 'masterfooter.php';
?>
</body>

</html>
