<?php
include('conexion.php');

// Verificar si se ha enviado el formulario de actualización de cantidad
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
        $sql_insert_entrada = "INSERT INTO entradas (vehiculo_id, cantidad, fecha_entrada)
                               VALUES ($vehiculo_id, $cantidad, NOW())";

        if ($conn->query($sql_update_inventario) === TRUE && 
            $conn->query($sql_update_vehiculos) === TRUE && 
            $conn->query($sql_insert_entrada) === TRUE) {
            // Redirigir después de actualizar para evitar reenvío del formulario
            header("Location: vehiculos.php?success=1");
            exit();
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    } else {
        echo "Por favor, ingresa una cantidad válida (mayor a 0).";
    }
}

// Consultar todos los vehículos
$sql = "SELECT v.id, v.marca, v.modelo, v.año, v.precio, 
               IFNULL(i.cantidad, 0) AS cantidad
        FROM vehiculos v
        LEFT JOIN inventario i ON v.id = i.vehiculo_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Vehículos</title>
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
    </style>
</head>
<body>
    <h1>Gestión de Vehículos</h1>

    <?php if (isset($_GET['success'])): ?>
        <p style="text-align:center; color: #EAD196;">¡Inventario actualizado correctamente!</p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Actualizar Cantidad</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['marca'] ?></td>
            <td><?= $row['modelo'] ?></td>
            <td><?= $row['año'] ?></td>
            <td><?= $row['precio'] ?></td>
            <td><?= $row['cantidad'] ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="vehiculo_id" value="<?= $row['id'] ?>">
                    <input type="number" name="cantidad" min="1" placeholder="Cantidad">
                    <button class="btn" type="submit" name="update_inventory">Actualizar</button>
                </form>
            </td>
            <td>
                <form action="editar_vehiculo.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="btn" type="submit">Editar</button>
                </form>
                <form action="eliminar_vehiculo.php" method="GET" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="btn" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="action-buttons">
        <form action="dashboard_inventario.php" method="GET" style="display:inline;">
            <button class="btn" type="submit">Regresar al Dashboard</button>
        </form>
        <form action="agregar_vehiculo.php" method="GET" style="display:inline;">
            <button class="btn" type="submit">Agregar Vehículo</button>
        </form>
        <form action="filtro.php" method="GET" style="display:inline;">
            <button class="btn" type="submit">Filtrar Vehículo</button>
        </form>
        
    </div>
</body>
</html>
