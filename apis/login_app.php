<?php
require 'pdo_conexion.php'; // Asegúrate de cambiar esto por la ruta a tu script de configuración de la base de datos.

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    // Corrección: Utilizar la variable $input para obtener ambos, email y contraseña.
    $email = $input['usuario'];
    $password = $input['contrasena'];

    if (empty($email) || empty($password)) {
        echo json_encode(['message' => 'Email y contraseña son requeridos.']);
        http_response_code(200); // Bad Request
        exit;
    }

    // Preparar la consulta SQL para buscar al usuario por email de manera segura para prevenir inyecciones SQL
    $sql = "SELECT * FROM users WHERE usuario_users = :email"; // Corrección: usar marcadores de posición nombrados
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]); // Corrección: pasar el parámetro de manera segura
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['con_users'])) {
        // La contraseña es correcta
        echo json_encode(['message' => 'Inicio de sesión exitoso.']);
        http_response_code(200); // OK
    } else {
        // Credenciales inválidas
        echo json_encode(['message' => 'Email o contraseña incorrectos.']);
        http_response_code(200); // Unauthorized
    }
} else {
    echo json_encode(['message' => 'Método HTTP no permitido.']);
    http_response_code(200); // Method Not Allowed
}
?>