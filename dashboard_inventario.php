<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar que el usuario es Gerente de Inventario
if ($_SESSION['rol_id'] != 2) {
    echo "Acceso denegado. Este contenido es exclusivo para el Gerente de Inventario.";
    exit();
}

// Mostrar el mensaje de bienvenida
echo "<h1>Bienvenido, " . $_SESSION['nombre'] . "</h1>";
echo "<p>Tu rol es: Gerente de Inventario</p>";
?>

<!-- Opciones del dashboard para Gerente de Inventario -->
<br><br>
<h2>Panel de Gerente de Inventario</h2>

<form action="vehiculos.php" method="get">
    <button type="submit" class="btn-gestion">Gestionar Vehículos</button>
</form>

<!-- Enlace para cerrar sesión -->
<br>
<a href="logout.php" class="btn-logout">Cerrar sesión</a>

<style>
    /* Estilos generales */
    body {
        font-family: 'Noto Serif', serif;
        background-color: #eaeaea;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        min-height: 100vh;
        background: linear-gradient(135deg, #7D0A0A, #060505);
        color: white;
    }

    h1 {
        font-size: 32px;
        margin: 20px;
        color: #EAD196;
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);
    }

    p {
        font-size: 18px;
        color: #EAD196;
        margin-bottom: 40px;
    }

    h2 {
        font-size: 28px;
        margin: 20px;
        color: #EAD196;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Botones */
    .btn-gestion, .btn-logout {
        background-color: #7D0A0A;
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 10px 0;
    }

    .btn-gestion:hover {
        background-color: #BF3131;
    }

    .btn-logout {
        background-color: #060505;
    }

    .btn-logout:hover {
        background-color: #7D0A0A;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        h1 {
            font-size: 28px;
        }

        h2 {
            font-size: 24px;
        }

        .btn-gestion, .btn-logout {
            font-size: 16px;
            padding: 10px 20px;
        }
    }
</style>
