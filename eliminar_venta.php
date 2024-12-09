<?php
include('conexion.php');

// Verificar si se ha pasado un ID de venta por la URL
if (isset($_GET['id'])) {
    $venta_id = $_GET['id'];

    // Consultar si la venta existe
    $sql = "SELECT * FROM ventas WHERE id = $venta_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Eliminar la venta
        $sql_delete = "DELETE FROM ventas WHERE id = $venta_id";
        
        if ($conn->query($sql_delete) === TRUE) {
            echo "Venta eliminada exitosamente";
        } else {
            echo "Error al eliminar la venta: " . $conn->error;
        }
    } else {
        echo "Venta no encontrada.";
    }
} else {
    echo "ID de venta no proporcionado.";
}

$conn->close();
?>

<div class="container">
    <h2>Eliminar Venta</h2>
    <p>La venta se ha eliminado correctamente.</p>
    <form action="ver_ventas.php" method="get">
        <button type="submit" class="back-button">Regresar a Ventas</button>
    </form>
</div>

<style>
    /* Fondo completo para toda la página */
    body {
        font-family: 'Noto Serif', serif;
        background-color: #EAD196; /* Color de fondo de la paleta */
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        min-height: 100vh;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.9); /* Fondo semitransparente */
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 600px;
        margin-top: 40px;
        text-align: center;
    }

    h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #060505;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    p {
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
    }

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
        .container {
            width: 100%;
        }

        h2 {
            font-size: 24px;
        }
    }
</style>
