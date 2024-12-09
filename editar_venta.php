<?php
include('conexion.php');

// Verificar si se ha pasado un ID de venta por la URL
if (isset($_GET['id'])) {
    $venta_id = $_GET['id'];

    // Consultar la venta actual
    $sql = "SELECT * FROM ventas WHERE id = $venta_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Recuperar los datos de la venta
        $venta = $result->fetch_assoc();

        // Consultar usuarios que tienen el rol de cliente
        $sql_usuarios = "SELECT u.id, u.nombre 
                         FROM usuarios u 
                         INNER JOIN roles r ON u.rol_id = r.id 
                         WHERE r.nombre = 'Cliente'";
        $result_usuarios = $conn->query($sql_usuarios);

        // Consultar vehículos disponibles
        $sql_vehiculos = "SELECT id, modelo FROM vehiculos";
        $result_vehiculos = $conn->query($sql_vehiculos);

        // Actualizar la venta si se ha enviado el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario_id = $_POST['usuario_id'];
            $vehiculo_id = $_POST['vehiculo_id'];
            $fecha_venta = $_POST['fecha_venta'];
            $monto = $_POST['monto'];

            // Actualizar los datos en la base de datos
            $sql_update = "UPDATE ventas 
                           SET usuario_id = '$usuario_id', 
                               vehiculo_id = '$vehiculo_id', 
                               fecha_venta = '$fecha_venta', 
                               monto = '$monto' 
                           WHERE id = $venta_id";

            if ($conn->query($sql_update) === TRUE) {
                echo "Venta actualizada exitosamente";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    } else {
        echo "Venta no encontrada.";
    }
} else {
    echo "ID de venta no proporcionado.";
}

$conn->close();
?>

<h2>Editar Venta</h2>

<?php if (isset($venta)) { ?>
    <form method="POST" class="venta-form">
        Fecha de Venta: <input type="date" name="fecha_venta" value="<?php echo $venta['fecha_venta']; ?>" required><br><br>

        Usuario: 
        <select name="usuario_id" required>
            <option value="">Seleccione un usuario</option>
            <?php
            // Mostrar usuarios en el formulario
            if ($result_usuarios->num_rows > 0) {
                while ($row = $result_usuarios->fetch_assoc()) {
                    $selected = ($row["id"] == $venta["usuario_id"]) ? "selected" : "";
                    echo "<option value='" . $row["id"] . "' $selected>" . $row["nombre"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay usuarios disponibles</option>";
            }
            ?>
        </select><br><br>

        Vehículo: 
        <select name="vehiculo_id" required>
            <option value="">Seleccione un vehículo</option>
            <?php
            // Mostrar vehículos en el formulario
            if ($result_vehiculos->num_rows > 0) {
                while ($row = $result_vehiculos->fetch_assoc()) {
                    $selected = ($row["id"] == $venta["vehiculo_id"]) ? "selected" : "";
                    echo "<option value='" . $row["id"] . "' $selected>" . $row["modelo"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay vehículos disponibles</option>";
            }
            ?>
        </select><br><br>

        Monto: <input type="number" name="monto" value="<?php echo $venta['monto']; ?>" required><br><br>

        <input type="submit" value="Actualizar Venta">
    </form>
<?php } ?>

<form action="ver_ventas.php" method="get">
    <button type="submit" class="back-button">Regresar</button>
</form>

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

    h2 {
        font-size: 28px;
        margin: 20px;
        color: #060505;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .venta-form {
        background-color: rgba(255, 255, 255, 0.9); /* Fondo semitransparente */
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 600px;
        margin: 20px;
    }

    .venta-form input, .venta-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .venta-form input[type="submit"] {
        background-color: #7D0A0A;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .venta-form input[type="submit"]:hover {
        background-color: #BF3131;
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
        .venta-form {
            width: 100%;
        }

        h2 {
            font-size: 24px;
        }
    }
</style>
