<?php

include "masterHead.php";


// Configuración de la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "proyecto1";


$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_errno) {
    die("<div class='alert alert-danger'>Error de conexión: " . htmlspecialchars($conn->connect_error) . "</div>");
}

// Manejo de POST para editar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $id = intval($_POST['id']);
    $Nombre = $conn->real_escape_string(trim($_POST['Nombre']));
    $Precio_Compra = floatval($_POST['Precio_Compra']);
    $Precio_Venta = floatval($_POST['Precio_Venta']);
    $Fecha = date('Y-m-d', strtotime($_POST['Fecha']));
    $Cantidad = intval($_POST['Cantidad']);

    // Preparar la consulta SQL base
    $sql = "UPDATE productos SET 
            Nombre = ?, 
            Precio_Compra = ?, 
            Precio_Venta = ?, 
            Fecha = ?, 
            Cantidad = ?";

    $params = [$Nombre, $Precio_Compra, $Precio_Venta, $Fecha, $Cantidad];
    $types = "sddsi";

    // Procesar la foto si se subió una nueva
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
        $foto_nombre = uniqid() . '_' . basename($_FILES['Foto']['name']);
        $ruta_destino = 'uploads/' . $foto_nombre;

        if (move_uploaded_file($_FILES['Foto']['tmp_name'], $ruta_destino)) {
            $sql .= ", Foto = ?";
            $params[] = $foto_nombre;
            $types .= "s";
        }
    }

    $sql .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "<script>
                alert('Producto actualizado exitosamente');
                window.location.href = window.location.href;
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar el producto.</div>";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

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
        .edite-button {
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            background: linear-gradient(145deg, #a05fff, #6b30ff);
            color: white;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
        }

        .edite-button:hover {
            background: linear-gradient(145deg, #6b30ff, #a05fff);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .edite-button:active {
            transform: translateY(0);
            box-shadow: none;
        }


        .edite-button:disabled {
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

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Productos</h1>
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
                    <th>Acciones</th>
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
                    if (!empty($row['Foto'])) {
                        echo "<img src='uploads/" . htmlspecialchars($row['Foto']) . "' alt='Producto' style='width: 50px; height: 50px; object-fit: cover;'>";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row['Cantidad']) . "</td>";
                    echo "<td>";

                    echo "<button type='button' class='edite-button' data-bs-toggle='modal' data-bs-target='#editModal' 
                            onclick='setEditData(\"" . $row['id'] . "\", 
                                               \"" . htmlspecialchars($row['Nombre']) . "\", 
                                               \"" . $row['Precio_Compra'] . "\", 
                                               \"" . $row['Precio_Venta'] . "\", 
                                               \"" . $row['Fecha'] . "\", 
                                               \"" . $row['Cantidad'] . "\")'>
                            Editar
                          </button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>

                </tbody>
            </table>
        </div>

        <!-- Modal de Edición -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="edit_id" name="id">

                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="edit_nombre" name="Nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_precio_compra" class="form-label">Precio Compra</label>
                                <input type="number" step="0.01" class="form-control" id="edit_precio_compra" name="Precio_Compra" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_precio_venta" class="form-label">Precio Venta</label>
                                <input type="number" step="0.01" class="form-control" id="edit_precio_venta" name="Precio_Venta" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="edit_fecha" name="Fecha" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="edit_foto" name="Foto" accept="image/*">
                                <small class="text-muted">Dejar en blanco para mantener la imagen actual</small>
                            </div>

                            <div class="mb-3">
                                <label for="edit_cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="edit_cantidad" name="Cantidad" required>
                            </div>

                            <div class="modal-footer">

                                <button type="button"   class="edite-button" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="edite-button">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <h121>ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤsugh<h121>
    </main>

    <script>
        function setEditData(id, nombre, precioCompra, precioVenta, fecha, cantidad) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_precio_compra').value = precioCompra;
            document.getElementById('edit_precio_venta').value = precioVenta;
            document.getElementById('edit_fecha').value = fecha;
            document.getElementById('edit_cantidad').value = cantidad;
        }
    </script>

<?php
$conn->close();
?>

