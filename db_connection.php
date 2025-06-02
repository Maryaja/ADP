<?php
$servername = "localhost";   
$username = "root";
$password = "";        
$database = "dronautic";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
    // Establecer el modo de error PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Importante para seguridad
    //echo "Conexión exitosa"; // Para pruebas, luego coméntalo o elimínalo
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Función para cerrar la conexión (opcional, pero buena práctica)
function closeConnection() {
    global $conn;
    $conn = null;
}
?>