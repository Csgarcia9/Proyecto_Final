<?php

global $conexion;

$server = 'localhost';    
$user = 'cesdev';         
$pass = 'Cgb1003153006*';
$db = 'tienda';           

// Conectar a la base de datos
try {
    $conexion = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
