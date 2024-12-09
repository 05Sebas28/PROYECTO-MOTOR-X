<?php
include('conexion.php');

// Eliminar vehículo por ID
$id = $_GET['id'];
$sql = "DELETE FROM vehiculos WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: vehiculos.php"); // Redirigir al listado de vehículos después de eliminar
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Vehículo</title>
    <style>
        body {
            font-family: 'Noto Serif', serif;
            background-color: #EAD196;
            color: #060505;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .message {
            font-size: 20px;
            color: #060505;
            margin-bottom: 30px;
            text-align: center;
        }

        form {
            background-color: #BF3131;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
            text-align: center;
        }

        button {
            background-color: #7D0A0A;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #BF3131;
        }
    </style>
</head>
<body>

    <div class="message">
        <p>Vehículo eliminado exitosamente.</p>
    </div>

    <form action="vehiculos.php" method="get">
        <button type="submit">Gestionar Vehículos</button>
    </form>

</body>
</html>
