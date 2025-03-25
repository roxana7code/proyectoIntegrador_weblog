<?php
// Database connection details
$host = 'localhost';
$dbname = 'blog_database';
$username = 'root';
$password = '12345678';

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit(); // Terminate script if connection fails
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['email']);
    $pass = trim($_POST['contrasena']);

    // Query to verify the user
    $stmt = $pdo->prepare("SELECT * FROM `login` WHERE email LIKE :email AND contrasena LIKE :contrasena");
    $stmt->execute(['email' => $user, 'contrasena' => $pass]);
    $userRecord = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userRecord) {
        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso! Bienvenido, ' . htmlspecialchars($userRecord['nombre'])]);
        } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.history.back();</script>";
    }
}
?>
