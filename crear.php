<?php
include "masterHead.php";
$server = "localhost";
$user = "root";
$pass = "";
$db = "proyecto1";

// Crear conexión y verificar errores
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_errno) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Productos</h1>
            <button type="button" class="create-button" data-bs-toggle="modal" data-bs-target="#crearProductoModal">
                Crear Producto
            </button>
        </div>

        <!-- Tabla de productos -->
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

                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM productos ORDER BY id DESC";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
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
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br>
<h121>ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤsugh<h121>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                .create-button {
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    background: linear-gradient(145deg, #a05fff, #6b30ff);
                    color: white;
                    transition: all 0.3s ease;
                    cursor: pointer;
                    font-family: 'Arial', sans-serif;
                }

                .create-button:hover {
                    background: linear-gradient(145deg, #6b30ff, #a05fff);
                    transform: translateY(-1px);
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                }

                /* Efecto active (cuando se presiona) */
                .create-button:active {
                    transform: translateY(0);
                    box-shadow: none;
                }


                .create-button:disabled {
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

        <!-- Modal para crear producto -->
        <div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearProductoModalLabel">Crear Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="crear.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="Nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="Precio_Compra" class="form-label">Precio de Compra</label>
                                <input type="number" class="form-control" id="Precio_Compra" name="Precio_Compra" required step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="Precio_Venta" class="form-label">Precio de Venta</label>
                                <input type="number" class="form-control" id="Precio_Venta" name="Precio_Venta" required step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="number" class="form-control" id="id" name="id" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="Fecha" required>
                            </div>
                            <div class="mb-3">
                                <label for="fotos" class="form-label">Fotos</label>
                                <input type="file" class="form-control" id="fotos" name="Foto" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="Cantidad" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="create-button" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="create-button">Crear Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Obtener y sanitizar los datos del formulario
                $Nombre = $conn->real_escape_string($_POST['Nombre']);
                $Precio_Compra = floatval($_POST['Precio_Compra']);
                $Precio_Venta = floatval($_POST['Precio_Venta']);
                $fecha = date('Y-m-d', strtotime($_POST['Fecha']));
                $cantidad = intval($_POST['Cantidad']);
                $id = intval($_POST['id']);

                // Procesar la foto
                $foto = '';
                if(isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
                    $allowed = ['image/jpeg', 'image/png', 'image/gif'];
                    if(in_array($_FILES['Foto']['type'], $allowed)) {
                        $foto_nombre = uniqid() . '_' . $_FILES['Foto']['name'];
                        $ruta_destino = 'uploads/' . $foto_nombre;

                        // Crear el directorio si no existe
                        if (!file_exists('uploads')) {
                            mkdir('uploads', 0777, true);
                        }

                        if(move_uploaded_file($_FILES['Foto']['tmp_name'], $ruta_destino)) {
                            $foto = $foto_nombre;
                        } else {
                            throw new Exception("Error al subir la imagen");
                        }
                    } else {
                        throw new Exception("Tipo de archivo no permitido");
                    }
                }

                // Preparar la consulta SQL
                $insertarDatos = "INSERT INTO productos (id, Nombre, Precio_Compra, Precio_Venta, fecha, foto, cantidad) VALUES (?, ?, ?, ?, ?, ?, ?)";

                // Preparar el statement y verificar errores
                if ($stmt = $conn->prepare($insertarDatos)) {
                    // Vincular los parámetros
                    $stmt->bind_param("isddsis", $id, $Nombre, $Precio_Compra, $Precio_Venta, $fecha, $foto, $cantidad);

                    // Ejecutar la consulta y verificar el resultado
                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Producto creado exitosamente');
                            window.location.href = window.location.href;
                          </script>";
                    } else {
                        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
                    }

                    // Cerrar el statement
                    $stmt->close();
                } else {
                    throw new Exception("Error en la preparación de la consulta: " . $conn->error);
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
            }
        }
        ?>
    </main>

<?php
// Cerrar la conexión
$conn->close();

include "masterfooter.php";
?>