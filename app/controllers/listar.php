<?php
require_once "../bd/conexion.php";

try {
    // Solo seleccionamos todo de contactos porque ya incluye el nombre_categoria
    $sql = "SELECT * FROM contactos ORDER BY fecha_registro DESC";
            
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    
    $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Error al listar Contactos: " . $e->getMessage());
}
?>