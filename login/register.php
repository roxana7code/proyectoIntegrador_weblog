<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'blog_database';
$username = 'root';
$password = '12345678';



// Crear una nueva conexión PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// Establecer el modo de error de PDO a excepción
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $contrasena = trim($_POST['contrasena']);
    $email = trim($_POST['email']);

    $stmt = $pdo->prepare("INSERT INTO `login` (nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)");

    try {
        $stmt->execute(['nombre' => $nombre, 'email' => $email, 'contrasena' => $contrasena]);
        echo "<script>alert('User registered successfully!'); window.location.href='LoginB.html';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        echo $email;
    }
}
?>