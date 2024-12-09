<?php
$servername = "localhost";
$username = "root";
$password = "";  // Si usas contraseña, ponla aquí
$dbname = "sistemaventas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
