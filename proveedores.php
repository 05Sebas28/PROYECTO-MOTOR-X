<?php
include('conexion.php');

// Obtener proveedores
$sql = "SELECT * FROM proveedores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de que la ruta al CSS sea correcta -->
    <style>
        /* Ajustes específicos para este archivo */
        .container {
            background-color: var(--accent-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 20px auto;
        }

        .container h1 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .alert {
            text-align: center;
            font-size: 18px;
            color: var(--primary-color);
            margin: 20px 0;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .actions a {
            text-decoration: none;
            font-family: 'Playfair Display', serif;
            background-color: var(--secondary-color);
            color: var(--accent-color);
            padding: 10px 15px;
            border-radius: 5px;
        }

        .actions a:hover {
            background-color: var(--primary-color);
            color: var(--dark-color);
        }

        .actions form {
            margin: 0;
        }

        .actions button {
            width: 100%;
        }

        .add-btn {
            display: block;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Proveedores</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['telefono'] ?></td>
                            <td>
                                <a href="editar_proveedor.php?id=<?= $row['id'] ?>" class="action-button">Editar</a>
                                <a href="eliminar_proveedor.php?id=<?= $row['id'] ?>" class="action-button" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert">No hay proveedores registrados.</p>
        <?php endif; ?>

        <div class="actions">
            <!-- Botón para agregar nuevo proveedor -->
            <a href="agregar_proveedor.php" class="add-btn action-button">Agregar Nuevo Proveedor</a>

            <!-- Botón para volver al dashboard -->
            <form action="dashboard.php" method="get">
                <button type="submit" class="action-button">Volver al Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>
