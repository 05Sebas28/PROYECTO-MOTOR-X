<?php
include('conexion.php');

// Consultar las ventas incluyendo la cantidad
$sql = "SELECT v.id, v.usuario_id, v.vehiculo_id, v.fecha_venta, v.monto, v.cantidad, u.nombre AS usuario, veh.modelo AS vehiculo
        FROM ventas v
        JOIN usuarios u ON v.usuario_id = u.id
        JOIN vehiculos veh ON v.vehiculo_id = veh.id";

$result = $conn->query($sql);

echo "<h2>Lista de Ventas</h2>";

echo "<table class='ventas-table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Vehículo</th>
                <th>Fecha de Venta</th>
                <th>Cantidad</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>";

if ($result->num_rows > 0) {
    // Mostrar los resultados
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["usuario"] . "</td>
                <td>" . $row["vehiculo"] . "</td>
                <td>" . $row["fecha_venta"] . "</td>
                <td>" . $row["cantidad"] . "</td> <!-- Mostrar la cantidad de vehículos vendidos -->
                <td>" . $row["monto"] . "</td>
                <td>
                    <a href='editar_venta.php?id=" . $row["id"] . "' class='edit-button'>Editar</a> | 
                    <a href='eliminar_venta.php?id=" . $row["id"] . "' class='delete-button'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class='no-results'>No se encontraron ventas.</p>";
}

$conn->close();
?>

<form action="ventas.php" method="get">
    <button class="back-button" type="submit">Regresar</button>
</form>

<style>
    /* Fondo de toda la página */
    body {
        font-family: 'Noto Serif', serif;
        background-color: #eaeaea; /* Fondo claro */
        background-image: url('background.jpg'); /* Fondo personalizado */
        background-size: cover;
        background-position: center;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        min-height: 100vh;
    }

    h2 {
        font-size: 28px;
        margin: 20px;
        color: #060505;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Sombra para mayor legibilidad */
    }

    /* Tabla */
    .ventas-table {
        width: 90%;
        max-width: 1200px;
        margin: 20px;
        border-collapse: collapse;
        background-color: rgba(255, 255, 255, 0.9); /* Fondo semitransparente para la tabla */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .ventas-table th, .ventas-table td {
        padding: 12px;
        text-align: center;
    }

    .ventas-table th {
        background-color: #7D0A0A;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
    }

    .ventas-table td {
        background-color: #f4f4f4;
        font-size: 14px;
    }

    .ventas-table tr:nth-child(even) td {
        background-color: #e2e2e2;
    }

    /* Botones de acción */
    .edit-button, .delete-button {
        padding: 6px 12px;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .edit-button {
        background-color: #7D0A0A;
    }

    .edit-button:hover {
        background-color: #BF3131;
    }

    .delete-button {
        background-color: #060505;
    }

    .delete-button:hover {
        background-color: #7D0A0A;
    }

    /* Mensaje de no resultados */
    .no-results {
        font-size: 16px;
        color: #060505;
        text-align: center;
        margin-top: 20px;
    }

    /* Botón de regreso */
    .back-button {
        background-color: #7D0A0A;
        color: #fff;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        text-align: center;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 20px;
    }

    .back-button:hover {
        background-color: #BF3131;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        .ventas-table {
            width: 100%;
        }

        h2 {
            font-size: 24px;
        }
    }
</style>
