<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar proveedor
    $sql = "DELETE FROM proveedores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Proveedor eliminado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Botón para volver a agregar_proveedor.php -->
<br><br>
<form action="agregar_proveedor.php" method="get">
    <button type="submit">Volver a Agregar Proveedor</button>
</form>
