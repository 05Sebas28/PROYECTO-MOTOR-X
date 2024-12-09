<?php
include('conexion.php');

// Verifica si se ha recibido el ID del usuario a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Cargar el usuario con el ID recibido
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conn->query($sql);

    // Verifica si el usuario existe
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "<div class='form-container'>Usuario no encontrado.</div>";
        exit;
    }
}

// Verifica si se ha enviado el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'] ? password_hash($_POST['contraseña'], PASSWORD_BCRYPT) : $usuario['contraseña'];
    $rol_id = $_POST['rol_id'];

    // Actualiza el usuario en la base de datos
    $sql_update = "UPDATE usuarios SET nombre='$nombre', correo='$correo', contraseña='$contraseña', rol_id='$rol_id' WHERE id=$id";
    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='form-container'>Usuario actualizado exitosamente.</div>";
    } else {
        echo "<div class='form-container'>Error al actualizar: " . $conn->error . "</div>";
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
    <title>Editar Usuario</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Editar Usuario</h1>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" placeholder="Deja vacío para no cambiar">

            <label for="rol_id">Rol:</label>
            <select id="rol_id" name="rol_id" required>
                <?php
                if ($result_roles->num_rows > 0) {
                    while ($row = $result_roles->fetch_assoc()) {
                        $selected = ($usuario['rol_id'] == $row['id']) ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay roles disponibles</option>";
                }
                ?>
            </select>

            <input type="submit" value="Actualizar Usuario">
        </form>

        <!-- Botón para volver a usuarios.php -->
        <form action="usuarios.php" method="get">
            <button type="submit">Volver a Usuarios</button>
        </form>
    </div>
</body>
</html>
