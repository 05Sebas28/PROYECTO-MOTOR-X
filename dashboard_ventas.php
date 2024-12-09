<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar que el usuario es Gerente de Inventario
if ($_SESSION['rol_id'] != 3) {
    echo "<div class='error-message'>Acceso denegado. Este contenido es exclusivo para el Gerente de Ventas.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Gerente de Ventas</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ruta correcta a tu CSS -->
    <style>
        body {
            font-family: 'Noto Serif', serif;
            background-color: var(--accent-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .panel-container {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            color: var(--accent-color);
            text-align: center;
            width: 90%;
            max-width: 600px;
            font-family: 'Playfair Display', serif;
        }

        .panel-container h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .panel-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .welcome-message {
            font-size: 18px;
            margin: 15px 0;
            color: var(--accent-color);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .action-buttons button {
            background-color: var(--accent-color);
            color: var(--dark-color);
            border: none;
            padding: 15px;
            font-size: 16px;
            font-family: 'Playfair Display', serif;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .action-buttons button:hover {
            background-color: var(--secondary-color);
            color: var(--accent-color);
            transform: scale(1.05);
        }

        .logout-link {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            color: var(--accent-color);
            transition: color 0.3s ease;
        }

        .logout-link:hover {
            color: var(--dark-color);
        }

        .error-message {
            color: var(--primary-color);
            background-color: var(--accent-color);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-weight: bold;
            max-width: 400px;
            margin: 50px auto;
        }
    </style>
</head>
<body>
    <div class="panel-container">
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']); ?></h1>
        <p class="welcome-message">Tu rol es: <strong>Gerente de Ventas</strong></p>
        <h2>Opciones del Panel</h2>

        <div class="action-buttons">
            <form action="ventas.php" method="get">
                <button type="submit">Gestionar Ventas</button>
            </form>
        </div>

        <a href="logout.php" class="logout-link">Cerrar sesión</a>
    </div>
</body>
</html>
