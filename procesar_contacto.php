<?php
require_once 'db_connection.php';

header('Content-Type: application/json'); // Importante: Indica que la respuesta es JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario (¡Sanitizar y validar!)
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    // Validación (¡IMPORTANTE!)
    if (empty($nombre) || empty($correo) || empty($mensaje)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
        exit();
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
        exit();
    }

    try {
        // Sentencia preparada (¡SEGURIDAD!)
        $sql = "INSERT INTO contactos (nombre, correo, mensaje) VALUES (:nombre, :correo, :mensaje)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->execute();

        // Enviar una respuesta JSON de éxito
        echo json_encode(['success' => true, 'message' => '¡Mensaje enviado con éxito!']);
        exit();

    } catch (PDOException $e) {
        // Enviar una respuesta JSON de error
        echo json_encode(['success' => false, 'message' => 'Error al guardar el mensaje: ' . $e->getMessage()]);
        exit();
    }

    closeConnection();
} else {
    // Enviar una respuesta JSON de error si alguien accede directamente
    echo json_encode(['success' => false, 'message' => 'Acceso no permitido.']);
}
?>