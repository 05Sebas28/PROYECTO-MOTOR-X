<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemaventas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];

    // Validación de campos
    if (!empty($nombre) && !empty($correo) && !empty($telefono) && !empty($contraseña)) {
        $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT); // Encriptar la contraseña

        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, telefono, contraseña, rol_id) VALUES ('$nombre', '$correo', '$telefono', '$contraseña_hash', 4)";

        if ($conn->query($sql) === TRUE) {
            // Mostrar alerta de éxito
            echo '<script>document.getElementById("alerta").style.display = "block";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Por favor complete todos los campos.";
    }
}

$conn->close();
?>

<head>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>
    <script src="assets/js/registro.js"></script>

    <div class="contenedor__todo">
        <div class="contenedor__login-register">
            <form method="post" action="registro.php">
                <h2 class="titulo-registro">Registro de Usuario</h2>
                
                <!-- Colocar la alerta justo debajo del título -->
                <div class="alerta" id="alerta" style="display: none;">
                    ¡Usuario registrado exitosamente!
                </div>

                <!-- Campos del formulario -->
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="email" name="correo" placeholder="Correo" required>
                <input type="text" name="telefono" placeholder="Teléfono" required>
                <input type="password" name="contraseña" placeholder="Contraseña" required>
                
                <!-- Botón de envío -->
                <button type="submit">Registrarse</button>
            </form>

            <!-- Formulario de inicio de sesión -->
            <form action="login.php" method="get">
                <button type="submit" class="regresar">¿Ya tienes cuenta? Inicia sesión</button>
            </form>
        </div>
    </div>
</body>
