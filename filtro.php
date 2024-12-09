<?php
include('conexion.php');

// Si se ha enviado el formulario de actualización de cantidad
if (isset($_POST['update_inventory'])) {
    $vehiculo_id = $_POST['vehiculo_id'];
    $cantidad = $_POST['cantidad'];

    if (is_numeric($cantidad) && $cantidad > 0) {
        // Actualizar la cantidad en la tabla de inventario
        $sql_update_inventario = "UPDATE inventario 
                                  SET cantidad = cantidad + $cantidad 
                                  WHERE vehiculo_id = $vehiculo_id";

        // Actualizar la cantidad en la tabla de vehículos
        $sql_update_vehiculos = "UPDATE vehiculos 
                                 SET cantidad = cantidad + $cantidad 
                                 WHERE id = $vehiculo_id";

        // Insertar la entrada en la tabla de entradas
        $sql_insert_entrada = "INSERT INTO entradas (vehiculo_id, cantidad)
                               VALUES ($vehiculo_id, $cantidad)";

        if ($conn->query($sql_update_inventario) === TRUE && 
            $conn->query($sql_update_vehiculos) === TRUE && 
            $conn->query($sql_insert_entrada) === TRUE) {
            echo "Cantidad actualizada con éxito.";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    } else {
        echo "Por favor, ingresa una cantidad válida (mayor a 0).";
    }
}

// Consultar vehículos para el select
$sql_vehiculos = "SELECT id, marca, modelo FROM vehiculos";
$vehiculos_result = $conn->query($sql_vehiculos);

// Si se ha seleccionado un vehículo, realizamos las consultas
if (isset($_GET['vehiculo_id'])) {
    $vehiculo_id = $_GET['vehiculo_id'];

    // Consultar las ventas del vehículo seleccionado
    $sales_sql = "
        SELECT ve.id AS venta_id, ve.cantidad AS cantidad_venta, ve.fecha_venta, v.marca, v.modelo
        FROM ventas ve
        LEFT JOIN vehiculos v ON ve.vehiculo_id = v.id
        WHERE ve.vehiculo_id = $vehiculo_id
        ORDER BY ve.fecha_venta DESC
    ";

    // Consultar las entradas del vehículo seleccionado
    $entradas_sql = "
        SELECT e.cantidad AS cantidad_entrada, e.fecha_entrada, v.marca, v.modelo
        FROM entradas e
        LEFT JOIN vehiculos v ON e.vehiculo_id = v.id
        WHERE e.vehiculo_id = $vehiculo_id
        ORDER BY e.fecha_entrada DESC
    ";

    // Consultar el vehículo específico para mostrar detalles
    $vehiculo_sql = "
        SELECT v.id, v.marca, v.modelo, v.año, v.precio, 
               IFNULL(i.cantidad, 0) AS cantidad_en_inventario 
        FROM vehiculos v 
        LEFT JOIN inventario i ON v.id = i.vehiculo_id
        WHERE v.id = $vehiculo_id
    ";

    $sales_result = $conn->query($sales_sql);
    $entradas_result = $conn->query($entradas_sql);
    $vehiculo_result = $conn->query($vehiculo_sql);
} else {
    // Si no se ha seleccionado un vehículo, se mantiene en la misma página
    $vehiculo_id = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Vehículos</title>
    <style>
        body {
            font-family: 'Noto Serif', serif;
            background-color: #060505;
            color: #EAD196;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #BF3131;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        h1 {
            text-align: center;
            color: #BF3131;
        }
        .btn {
            background-color: #BF3131;
            color: #EAD196;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin: 5px;
        }
        .btn:hover {
            background-color: #7D0A0A;
        }
        .action-buttons {
            text-align: center;
            margin: 20px 0;
        }
        select {
            padding: 10px;
            margin: 20px;
            background-color: #BF3131;
            color: #EAD196;
            border: 1px solid #BF3131;
        }
    </style>
</head>
<body>
    <h1>Filtrar Vehículos</h1>

    <!-- Formulario para seleccionar un vehículo -->
    <form action="filtro.php" method="get">
        <label for="vehiculo_id" style="color: #EAD196;">Selecciona un vehículo:</label>
        <select name="vehiculo_id" id="vehiculo_id" required>
            <option value="">Seleccione un vehículo</option>
            <?php while ($vehiculo = $vehiculos_result->fetch_assoc()): ?>
                <option value="<?= $vehiculo['id'] ?>" <?= ($vehiculo['id'] == $vehiculo_id) ? 'selected' : '' ?>>
                    <?= $vehiculo['marca'] ?> - <?= $vehiculo['modelo'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button class="btn" type="submit">Filtrar</button>
    </form>

    <!-- Mostrar los detalles del vehículo seleccionado -->
    <?php if ($vehiculo_id && isset($vehiculo_result) && $vehiculo_result->num_rows > 0): ?>
        <?php $vehiculo = $vehiculo_result->fetch_assoc(); ?>
        <h2>Detalles del Vehículo: <?= $vehiculo['marca'] ?> - <?= $vehiculo['modelo'] ?></h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Precio</th>
                <th>Cantidad en Inventario</th>
            </tr>
            <tr>
                <td><?= $vehiculo['id'] ?></td>
                <td><?= $vehiculo['marca'] ?></td>
                <td><?= $vehiculo['modelo'] ?></td>
                <td><?= $vehiculo['año'] ?></td>
                <td><?= $vehiculo['precio'] ?></td>
                <td><?= $vehiculo['cantidad_en_inventario'] ?></td>
            </tr>
        </table>

        <!-- Mostrar las ventas del vehículo seleccionado -->
        <h2>Ventas Realizadas</h2>
        <table>
            <tr>
                <th>Fecha de Venta</th>
                <th>Cantidad Vendida</th>
                <th>Marca</th>
                <th>Modelo</th>
            </tr>
            <?php while ($sale = $sales_result->fetch_assoc()): ?>
            <tr>
                <td><?= $sale['fecha_venta'] ?></td>
                <td><?= $sale['cantidad_venta'] ?></td>
                <td><?= $sale['marca'] ?></td>
                <td><?= $sale['modelo'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Mostrar las entradas del vehículo seleccionado -->
        <h2>Entradas del Vehículo</h2>
        <table>
            <tr>
                <th>Fecha de Entrada</th>
                <th>Cantidad Añadida</th>
                <th>Marca</th>
                <th>Modelo</th>
            </tr>
            <?php while ($entrada = $entradas_result->fetch_assoc()): ?>
            <tr>
                <td><?= $entrada['fecha_entrada'] ?></td>
                <td><?= $entrada['cantidad_entrada'] ?></td>
                <td><?= $entrada['marca'] ?></td>
                <td><?= $entrada['modelo'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

    <div class="action-buttons">
        <form action="vehiculos.php" method="GET" style="display:inline;">
            <button class="btn" type="submit">Regresar a la Gestión de Vehículos</button>
        </form>
    </div>
</body>
</html>
