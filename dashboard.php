<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Importar las tipografías de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?></h1>
        <h2>Tu rol es: 
            <?php
            switch ($_SESSION['rol_id']) {
                case 1:
                    echo "Administrador";
                    break;
                case 2:
                    echo "Gerente inventario";
                    break;
                case 3:
                    echo "Gerente Ventas";
                    break;
                case 4:
                    echo "Cliente";
                    break;
            }
            ?>
        </h2>

        <h3>¡Empecemos!</h3>
        <form action="usuarios.php" method="get">
            <button type="submit">Ir a gestión de usuarios</button>
        </form>
        <form action="proveedores.php" method="get">
            <button type="submit">Ir a gestión de proveedores</button>
        </form>

        <br>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
