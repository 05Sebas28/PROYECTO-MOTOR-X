<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del proveedor
    $sql = "SELECT * FROM proveedores WHERE id = $id";
    $result = $conn->query($sql);
    $proveedor = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE proveedores SET nombre = '$nombre', telefono = '$telefono' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>Proveedor actualizado exitosamente.</div>";
    } else {
        echo "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de que la ruta al CSS sea correcta -->
    <style>
        /* Estilos específicos para este archivo */
        .form-container {
            background-color: var(--accent-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
            font-family: 'Noto Serif', serif;
        }

        .form-container h1 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid var(--dark-color);
            border-radius: 5px;
            font-family: 'Noto Serif', serif;
        }

        .form-container input[type="submit"] {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: var(--primary-color);
            color: var(--dark-color);
        }

        .success {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            border-radius: 5px;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            border-radius: 5px;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .back-btn a {
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            background-color: var(--secondary-color);
            color: var(--accent-color);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .back-btn a:hover {
            background-color: var(--primary-color);
            color: var(--dark-color);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Editar Proveedor</h1>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= $proveedor['nombre'] ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?= $proveedor['telefono'] ?>" required>

            <input type="submit" value="Actualizar Proveedor">
        </form>

        <!-- Botón para volver a la lista de proveedores -->
        <div class="back-btn">
            <a href="proveedores.php">Volver a la Lista de Proveedores</a>
        </div>
    </div>
</body>
</html>
