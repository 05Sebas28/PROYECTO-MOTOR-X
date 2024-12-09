<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form action="usuarios.php" method="get">
    <button type="submit">Gestionar Usuarios</button>
</form>
