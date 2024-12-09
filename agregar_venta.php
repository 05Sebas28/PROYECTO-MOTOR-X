<?php
include('conexion.php');

// Consultar usuarios y vehículos disponibles
$sql_usuarios = "SELECT id, nombre FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);

$sql_vehiculos = "SELECT id, modelo FROM vehiculos";
$result_vehiculos = $conn->query($sql_vehiculos);

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $vehiculo_id = $_POST['vehiculo_id'];
    $fecha_venta = $_POST['fecha_venta'];
    $monto = $_POST['monto'];

    // Insertar venta en la base de datos
    $sql = "INSERT INTO ventas (usuario_id, vehiculo_id, fecha_venta, monto) 
            VALUES ('$usuario_id', '$vehiculo_id', '$fecha_venta', '$monto')";

    if ($conn->query($sql) === TRUE) {
        echo "Venta registrada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<h2>Agregar Venta</h2>

<form method="POST">
    Fecha de Venta: <input type="date" name="fecha_venta" required><br><br>

    Usuario: 
    <select name="usuario_id" required>
        <option value="">Seleccione un usuario</option>
        <?php
        // Mostrar usuarios en el formulario
        if ($result_usuarios->num_rows > 0) {
            while ($row = $result_usuarios->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
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
                echo "<option value='" . $row["id"] . "'>" . $row["modelo"] . "</option>";
            }
        } else {
            echo "<option value=''>No hay vehículos disponibles</option>";
        }
        ?>
    </select><br><br>

    Monto: <input type="number" name="monto" required><br><br>

    <input type="submit" value="Registrar Venta">
</form>
