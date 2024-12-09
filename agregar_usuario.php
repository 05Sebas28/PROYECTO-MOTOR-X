<?php
include('conexion.php');

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $rol_id = $_POST['rol_id'];

    // Inserta el usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol_id) VALUES ('$nombre', '$correo', '$contraseña', '$rol_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='form-container'>Usuario agregado exitosamente.</div>";
    } else {
        echo "<div class='form-container'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Cargar todos los roles desde la base de datos
$sql_roles = "SELECT * FROM roles";
$result_roles = $conn->query($sql_roles);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Agregar Nuevo Usuario</h1>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>

            <label for="rol_id">Rol:</label>
            <select id="rol_id" name="rol_id" required>
                <?php
                if ($result_roles->num_rows > 0) {
                    while ($row = $result_roles->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay roles disponibles</option>";
                }
                ?>
            </select>

            <input type="submit" value="Agregar Usuario">
        </form>

        <!-- Botón para volver a usuarios.php -->
        <form action="usuarios.php" method="get">
            <button type="submit">Volver a Usuarios</button>
        </form>
    </div>
</body>
</html>
