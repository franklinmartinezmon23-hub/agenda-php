<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "agenda";
$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try {
    $conexion = new PDO ($dsn, $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexion exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error de conexion: " . $e->getMessage();
}
$conexion = null;


?>