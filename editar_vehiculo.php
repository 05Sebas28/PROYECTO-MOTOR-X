<?php
include('conexion.php');

// Verificar si se ha recibido el ID del vehículo a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener el vehículo con el ID recibido
    $sql = "SELECT v.id, v.marca, v.modelo, v.año, v.precio, v.estado, i.cantidad 
            FROM vehiculos v 
            LEFT JOIN inventario i ON v.id = i.vehiculo_id 
            WHERE v.id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $vehiculo = $result->fetch_assoc();
    } else {
        echo "Vehículo no encontrado.";
        exit;
    }
}

// Verificar si se ha enviado el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $cantidad = $_POST['cantidad']; // Cantidad a modificar en el inventario

    // Actualizar el vehículo en la base de datos (en la tabla vehiculos)
    $sql_update = "UPDATE vehiculos SET marca = '$marca', modelo = '$modelo', año = '$año', 
                   precio = '$precio', estado = '$estado' WHERE id = $id";
    
    if ($conn->query($sql_update) === TRUE) {
        // Si la actualización del vehículo es exitosa, actualizar la cantidad en la tabla inventario
        // Primero verificamos si ya existe un registro en inventario para este vehículo
        $sql_check_inventory = "SELECT * FROM inventario WHERE vehiculo_id = $id";
        $result_inventory = $conn->query($sql_check_inventory);

        if ($result_inventory->num_rows > 0) {
            // Si ya existe, actualizamos la cantidad
            $sql_update_inventory = "UPDATE inventario SET cantidad = $cantidad WHERE vehiculo_id = $id";
        } else {
            // Si no existe, insertamos un nuevo registro
            $sql_update_inventory = "INSERT INTO inventario (vehiculo_id, cantidad) VALUES ($id, $cantidad)";
        }

        if ($conn->query($sql_update_inventory) === TRUE) {
            // Si la cantidad en inventario se actualiza correctamente
            header("Location: vehiculos.php");
            exit(); // Detener la ejecución después de redirigir
        } else {
            echo "Error al actualizar la cantidad en inventario: " . $conn->error;
        }
    } else {
        echo "Error al actualizar el vehículo: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vehículo</title>
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

        input[type="submit"], .back-button {
            background-color: #7D0A0A;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, .back-button:hover {
            background-color: #BF3131;
        }

        .back-button {
            margin-top: 10px;
            display: inline-block;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <h1>Editar Vehículo</h1>
        <form method="POST">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" value="<?php echo $vehiculo['marca']; ?>"><br>

            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" value="<?php echo $vehiculo['modelo']; ?>"><br>

            <label for="año">Año:</label>
            <input type="number" name="año" id="año" value="<?php echo $vehiculo['año']; ?>"><br>

            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" value="<?php echo $vehiculo['precio']; ?>"><br>

            <label for="estado">Estado:</label>
            <select name="estado" id="estado">
                <option value="Disponible" <?php echo ($vehiculo['estado'] == 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                <option value="Vendido" <?php echo ($vehiculo['estado'] == 'Vendido') ? 'selected' : ''; ?>>Vendido</option>
            </select><br>

            <label for="cantidad">Cantidad en Inventario:</label>
            <input type="number" name="cantidad" id="cantidad" value="<?php echo $vehiculo['cantidad']; ?>"><br>

            <div class="button-container">
                <input type="submit" value="Actualizar Vehículo">
                <form action="vehiculos.php" method="get">
                    <button class="back-button" type="submit">Volver a la lista de vehículos</button>
                </form>
            </div>
        </form>
    </div>
</body>
</html>
