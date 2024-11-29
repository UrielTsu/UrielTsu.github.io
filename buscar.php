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

$resultados = null;
$busqueda = '';

if (isset($_GET['buscar']) && !empty($_GET['termino'])) {
    $busqueda = $conn->real_escape_string($_GET['termino']);
    $sql = "SELECT * FROM productos WHERE 
            id LIKE '%$busqueda%' ";
    $resultados = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(45deg, #0f172a, #1e293b);
            color: #ffffff;
        }

        .main-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            padding: 2rem;
            margin: 2rem 0;
            animation: containerGlow 3s infinite alternate;
        }

        @keyframes containerGlow {
            from {
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            }
            to {
                box-shadow: 0 0 40px rgba(79, 70, 229, 0.2);
            }
        }

        .form-control {
            background: rgba(0, 0, 0, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            transition: all 0.3s ease;
            padding: 0.8rem;
            border-radius: 0.5rem;
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.3) !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.3) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #6d28d9) !important;
            border: none;
            padding: 0.8rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            color: #ffffff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9, #4f46e5) !important;
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.4);
        }

        .table {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            overflow: hidden;
            margin-top: 2rem;
        }

        .table thead {
            background: rgba(79, 70, 229, 0.1);
        }

        .table th {
            color: #ffffff;
            font-weight: 600;
            border-bottom: 2px solid rgba(79, 70, 229, 0.2);
            padding: 1rem;
        }

        .table td {
            color: #ffffff;
            padding: 1rem;
            border-bottom: 1px solid rgba(135, 135, 135, 0.1);
        }

        .table tbody tr:hover {
            background: rgba(79, 70, 229, 0.1);
            transition: all 0.3s ease;
        }

        .alert {
            background: rgba(79, 70, 229, 0.1);
            border: 1px solid rgba(79, 70, 229, 0.2);
            color: #ffffff;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        h1 {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #4f46e5, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        img {
            border-radius: 0.5rem;
            border: 2px solid rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>
<body>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="main-container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">Buscar Productos</h1>
        </div>

        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-8">
                    <input type="text"
                           name="termino"
                           class="form-control"
                           placeholder="Buscar por ID"
                           value="<?php echo htmlspecialchars($busqueda); ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" name="buscar" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        <?php if ($resultados && $resultados->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio de Compra</th>
                        <th>Precio de Venta</th>
                        <th>Fecha</th>
                        <th>Foto</th>
                        <th>Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $resultados->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                            <td>$<?php echo number_format($row['Precio_Compra'], 2); ?></td>
                            <td>$<?php echo number_format($row['Precio_Venta'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['Fecha']); ?></td>
                            <td>
                                <?php if (!empty($row['Foto'])): ?>
                                    <img src="uploads/<?php echo htmlspecialchars($row['Foto']); ?>"
                                         alt="Producto"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['Cantidad']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif (isset($_GET['buscar'])): ?>
            <div class="alert">No se encontraron resultados.</div>
        <?php endif; ?>
    </div>
</main>
</html>
<?php
$conn->close();
include "masterfooter.php";
?>
