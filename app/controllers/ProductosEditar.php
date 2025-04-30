<?php
require_once APP . '/models/DAO.php';
require_once APP . '/config/db.php'; // donde tienes $conexion PDO

$userDAO = new UserDAO($conexion);
$userDAO->editarProducto();

?>