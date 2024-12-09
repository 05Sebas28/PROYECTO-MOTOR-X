<?php
include('conexion.php');

// Variable para mostrar el mensaje de éxito
$success_message = "";

// Verificar si el formulario ha sido enviado para agregar vehículo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_vehiculo'])) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $cantidad = $_POST['cantidad'];

    // Comprobar si el vehículo ya existe por marca, modelo y año
    $sql_check_vehiculo = "SELECT id, cantidad FROM vehiculos WHERE marca = '$marca' AND modelo = '$modelo' AND año = '$año'";
    $result = $conn->query($sql_check_vehiculo);

    if ($result->num_rows > 0) {
        // Si el vehículo ya existe, actualizar la cantidad sumándola
        $vehiculo = $result->fetch_assoc();
        $vehiculo_id = $vehiculo['id'];
        $nueva_cantidad = $vehiculo['cantidad'] + $cantidad;

        $sql_update_vehiculo = "UPDATE vehiculos SET cantidad = $nueva_cantidad, precio = '$precio', estado = '$estado' WHERE id = $vehiculo_id";
        if ($conn->query($sql_update_vehiculo) === TRUE) {
            // Actualizar inventario
            $sql_update_inventario = "UPDATE inventario SET cantidad = $nueva_cantidad WHERE vehiculo_id = $vehiculo_id";
            $conn->query($sql_update_inventario);
            $success_message = "¡Vehículo actualizado exitosamente!";
        } else {
            echo "Error al actualizar el vehículo: " . $conn->error;
        }
    } else {
        // Si no existe, insertar un nuevo vehículo
        $sql_insert_vehiculo = "INSERT INTO vehiculos (marca, modelo, año, precio, estado, cantidad) 
                                VALUES ('$marca', '$modelo', '$año', '$precio', '$estado', '$cantidad')";

        if ($conn->query($sql_insert_vehiculo) === TRUE) {
            // Obtener el ID del nuevo vehículo insertado
            $vehiculo_id = $conn->insert_id;

            // Insertar en inventario
            $sql_insert_inventario = "INSERT INTO inventario (vehiculo_id, cantidad) 
                                      VALUES ('$vehiculo_id', '$cantidad')";
            if ($conn->query($sql_insert_inventario) === TRUE) {
                $success_message = "¡Vehículo agregado exitosamente!";
            } else {
                echo "Error al agregar el inventario: " . $conn->error;
            }
        } else {
            echo "Error al agregar el vehículo: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vehículo</title>
    <style>
        body {
            font-family: 'Noto Serif', serif;
            background-color: #EAD196;
            color: #060505;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        h1 {
            font-size: 36px;
            color: #060505;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            background-color: #BF3131;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #060505;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #060505;
            font-size: 16px;
            color: #060505;
        }

        input[type="submit"], button {
            background-color: #7D0A0A;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #BF3131;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .back-button {
            background-color: #060505;
            padding: 12px 24px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .success-message {
            text-align: center;
            color: green;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div>
        <h1>Agregar Vehículo</h1>

        <!-- Mostrar mensaje de éxito si existe -->
        <?php if (!empty($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required><br>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required><br>

            <label for="año">Año:</label>
            <input type="number" id="año" name="año" required><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" value="1" required><br>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="Disponible">Disponible</option>
                <option value="Vendido">Vendido</option>
            </select><br>

            <div class="button-container">
                <input type="submit" name="submit_vehiculo" value="Agregar Vehículo">
                <!-- Botón Regresar -->
                <button type="button" class="back-button" onclick="window.location.href='vehiculos.php'">Regresar</button>
            </div>
        </form>
    </div>

</body>
</html>
