<?php
// La contraseña que deseas convertir a hash
$contraseña = 'administrador101';

// Generar el hash
$hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Mostrar el hash generado
echo "El hash de la contraseña es: " . $hash;
?>
