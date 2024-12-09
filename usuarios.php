<?php
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <!-- Importar las tipografías -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>
        <?php
        $sql = "SELECT usuarios.id, usuarios.nombre, usuarios.correo, roles.nombre AS rol FROM usuarios INNER JOIN roles ON usuarios.rol_id = roles.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='styled-table'>";
            echo "<thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Rol</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["correo"] . "</td>
                        <td>" . $row["rol"] . "</td>
                        <td>
                            <a href='editar_usuario.php?id=" . $row["id"] . "' class='action-link'>Editar</a> | 
                            <a href='eliminar_usuario.php?id=" . $row["id"] . "' class='action-link'>Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No hay usuarios registrados.</p>";
        }
        ?>
        <a href='agregar_usuario.php' class="btn">Agregar Nuevo Usuario</a>
        <form action="dashboard.php" method="get">
            <button type="submit" class="btn">Regresar al Dashboard</button>
        </form>
    </div>
</body>
</html>
