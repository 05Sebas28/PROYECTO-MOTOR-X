<?php
include('conexion.php');

// Verificar si se ha enviado el formulario de actualización de cantidad
if (isset($_POST['update_inventory'])) {
    $vehiculo_id = $_POST['vehiculo_id'];
    $cantidad = $_POST['cantidad'];

    // Verificar si la cantidad es un número y no es negativa
    if (is_numeric($cantidad) && $cantidad >= 0) {
        // Actualizar la cantidad en inventario
        $sql_update_inventory = "UPDATE inventario SET cantidad = $cantidad WHERE vehiculo_id = $vehiculo_id";
        
        if ($conn->query($sql_update_inventory) === TRUE) {
            // También actualizar la cantidad en la tabla vehiculos
            $sql_update_vehiculo = "UPDATE vehiculos SET cantidad = $cantidad WHERE id = $vehiculo_id";
            if ($conn->query($sql_update_vehiculo) === TRUE) {
                echo "Cantidad actualizada correctamente en ambas tablas.";
            } else {
                echo "Error al actualizar la cantidad en la tabla de vehículos: " . $conn->error;
            }
        } else {
            echo "Error al actualizar la cantidad en inventario: " . $conn->error;
        }
    } else {
        echo "Por favor, ingresa una cantidad válida (número no negativo).";
    }
}

// Consultar todos los vehículos y su cantidad en inventario
$sql = "SELECT v.id, v.marca, v.modelo, v.año, v.precio, i.cantidad 
        FROM vehiculos v 
        LEFT JOIN inventario i ON v.id = i.vehiculo_id";
$result = $conn->query($sql);

// Mostrar vehículos
if ($result->num_rows > 0) {
    echo "<h1>Inventario de Vehículos</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Precio</th>
                <th>Cantidad en Inventario</th>
                <th>Acciones</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['marca'] . "</td>
                <td>" . $row['modelo'] . "</td>
                <td>" . $row['año'] . "</td>
                <td>" . $row['precio'] . "</td>
                <td>" . $row['cantidad'] . "</td>
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' name='vehiculo_id' value='" . $row['id'] . "'>
                        <input type='number' name='cantidad' value='" . $row['cantidad'] . "' min='0'>
                        <input type='submit' name='update_inventory' value='Actualizar Cantidad'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay vehículos en el inventario.";
}
?>

<!-- Botón para regresar al dashboard_inventario -->
<br>
<form action="dashboard_inventario.php" method="get">
    <button type="submit">Volver al Dashboard</button>
</form>
