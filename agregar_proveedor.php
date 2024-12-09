<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO proveedores (nombre, telefono) VALUES ('$nombre', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>Proveedor agregado exitosamente.</p>";
    } else {
        echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de que la ruta al CSS sea correcta -->
    <style>
        .form-container {
            background-color: var(--accent-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
            font-family: 'Noto Serif', serif;
        }

        .form-container h1 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .form-container label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: var(--dark-color);
        }

        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid var(--dark-color);
            border-radius: 5px;
            font-family: 'Noto Serif', serif;
        }

        .form-container input[type="submit"] {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            font-family: 'Playfair Display', serif;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: var(--primary-color);
            color: var(--dark-color);
        }

        .success-message,
        .error-message {
            text-align: center;
            font-size: 16px;
            margin: 10px 0;
            font-weight: bold;
        }

        .success-message {
            color: var(--primary-color);
        }

        .error-message {
            color: var(--dark-color);
        }

        .back-button {
            display: block;
            text-align: center;
            margin: 20px auto;
            background-color: var(--secondary-color);
            color: var(--accent-color);
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-family: 'Playfair Display', serif;
        }

        .back-button:hover {
            background-color: var(--primary-color);
            color: var(--dark-color);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Agregar Proveedor</h1>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>
            
            <input type="submit" value="Agregar Proveedor">
        </form>
    </div>

    <!-- Botón para volver a proveedores.php -->
    <a href="proveedores.php" class="back-button">Volver a la Lista de Proveedores</a>
</body>
</html>
