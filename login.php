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

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Validar los campos
    if (empty($correo) || empty($contraseña)) {
        $_SESSION['error'] = "Por favor complete ambos campos."; // Mensaje de error si falta algún dato
    } else {
        // Validar el correo
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            if (password_verify($contraseña, $usuario['contraseña'])) {
                // Contraseña correcta
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['rol_id'] = $usuario['rol_id'];

                // Redirigir según el rol del usuario
                switch ($usuario['rol_id']) {
                    case 1: // Administrador
                        header("Location: dashboard.php");
                        break;
                    case 2: // Gerente de inventario
                        header("Location: dashboard_inventario.php");
                        break;
                    case 3: // Gerente de ventas
                        header("Location: dashboard_ventas.php");
                        break;
                    case 4: // Cliente
                        header("Location: dashboard_cliente.php");
                        break;
                    default:
                        echo "Rol no identificado.";
                        break;
                }
                exit();
            } else {
                $_SESSION['error'] = "Contraseña incorrecta."; // Mensaje de error si la contraseña es incorrecta
            }
        } else {
            $_SESSION['error'] = "Correo no registrado."; // Mensaje de error si el correo no está registrado
        }
    }
}

$conn->close();
?>

<head>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>
    <script src="assets/js/login.js"></script>
</body>
<div class="contenedor__todo">
    <div class="contenedor__login-register">
        <form method="post" action="login.php">
            <h2>Iniciar Sesión</h2>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            
            <!-- Alerta de error, solo visible si hay un mensaje -->
            <div id="alertaError" class="alerta" style="display:none;">
                <!-- Aquí se mostrará el error -->
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>
        <form action="registro.php" method="get">
            <button type="submit" class="regresar">¿No tienes cuenta? Regístrate aquí</button>
        </form>
        <form action="index.php" method="get">
            <button type="submit" class="regresar">Regresar a la página Principal</button>
        </form>
    </div>
</div>

<script>
    // Comprobamos si hay un mensaje de error en la sesión
    <?php if (isset($_SESSION['error'])): ?>
        document.getElementById('alertaError').style.display = 'block';
        document.getElementById('alertaError').innerText = "<?php echo $_SESSION['error']; ?>";
        <?php unset($_SESSION['error']); // Limpiar mensaje de error después de mostrarlo ?>
    <?php endif; ?>
</script>
