<?php
include('conexion.php');

// Verificar si se ha recibido el ID del vehículo a marcar como vendido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Actualizar el estado del vehículo a "Vendido"
    $sql_update = "UPDATE vehiculos SET estado = 'Vendido' WHERE id = $id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Vehículo marcado como vendido.";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
