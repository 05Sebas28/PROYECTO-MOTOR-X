<?php
include('conexion.php');

// Consultar los vehículos disponibles
$sql_vehiculos = "SELECT id, marca, modelo FROM vehiculos";
$result_vehiculos = $conn->query($sql_vehiculos);

// Consultar los usuarios que tienen el rol de "Cliente"
$sql_usuarios = "SELECT id, nombre FROM usuarios WHERE rol_id = 4"; // Filtrar por rol_id
$result_usuarios = $conn->query($sql_usuarios);

// Crear venta
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $vehiculo_id = $_POST['vehiculo_id'];
    $cantidad_vendida = $_POST['cantidad'];

    // Verificar cantidad en inventario
    $sql_inventario = "SELECT cantidad FROM inventario WHERE vehiculo_id = $vehiculo_id";
    $result_inventario = $conn->query($sql_inventario);

    if ($result_inventario->num_rows > 0) {
        $row = $result_inventario->fetch_assoc();
        $cantidad_disponible = $row['cantidad'];

        if ($cantidad_disponible >= $cantidad_vendida) {
            // Registrar la venta
            $sql_venta = "INSERT INTO ventas (usuario_id, vehiculo_id, cantidad, monto) 
                          VALUES ('$usuario_id', '$vehiculo_id', '$cantidad_vendida', 
                          (SELECT precio FROM vehiculos WHERE id = $vehiculo_id) * $cantidad_vendida)";
            if ($conn->query($sql_venta) === TRUE) {
                // Actualizar inventario
                $sql_actualizar_inventario = "UPDATE inventario 
                                              SET cantidad = cantidad - $cantidad_vendida 
                                              WHERE vehiculo_id = $vehiculo_id";
                $conn->query($sql_actualizar_inventario);

                // Actualizar vehículos
                $sql_actualizar_vehiculos = "UPDATE vehiculos 
                                             SET cantidad = cantidad - $cantidad_vendida 
                                             WHERE id = $vehiculo_id";
                $conn->query($sql_actualizar_vehiculos);

                echo "Venta registrada exitosamente.";
            } else {
                echo "Error al registrar la venta: " . $conn->error;
            }
        } else {
            echo "Error: No hay suficiente cantidad disponible en el inventario.";
        }
    } else {
        echo "Error: Vehículo no encontrado en el inventario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Fondo con gradiente */
        body {
            font-family: 'Noto Serif', serif;
            background: linear-gradient(135deg, #7D0A0A, #BF3131);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        input[type="submit"], .action-button {
            background-color: #EAD196;
            color: #060505;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover, .action-button:hover {
            background-color: #BF3131;
            color: #fff;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons form {
            width: 48%;
        }

        .alert {
            text-align: center;
            font-size: 18px;
            color: #060505;
            margin-top: 20px;
        }

        /* Estilo para el botón */
        .back-button {
            background-color: #060505;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            width: 100%;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #7D0A0A;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Registrar Venta</h1>
        <form method="post">
            <label for="usuario">Usuario:</label>
            <select name="usuario_id" id="usuario" required>
                <option value="">Seleccione un usuario</option>
                <?php
                if ($result_usuarios->num_rows > 0) {
                    while ($row = $result_usuarios->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay usuarios disponibles</option>";
                }
                ?>
            </select>

            <label for="vehiculo">Vehículo:</label>
            <select name="vehiculo_id" id="vehiculo" required>
                <option value="">Seleccione un vehículo</option>
                <?php
                if ($result_vehiculos->num_rows > 0) {
                    while ($row = $result_vehiculos->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['marca'] . " " . $row['modelo'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay vehículos disponibles</option>";
                }
                ?>
            </select>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" required>

            <input type="submit" value="Registrar Venta">
        </form>

        <div class="action-buttons">
            <form action="ver_ventas.php" method="get">
                <button class="action-button" type="submit">Ver Ventas</button>
            </form>
            <form action="dashboard_ventas.php" method="get">
                <button class="action-button" type="submit">Regresar</button>
            </form>

        </div>


    </div>

</body>
</html>
