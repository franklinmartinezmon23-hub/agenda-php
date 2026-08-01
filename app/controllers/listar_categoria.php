<?php
$conexion_path = __DIR__ . '/../../bd/conexion.php';

if (file_exists($conexion_path)) {
    require_once $conexion_path;
} else {
    die("Error crítico: No se encontró el archivo de conexión en la ruta: " . $conexion_path);
}

try {
    // Cambiado de 'categorias' a 'categoria' en singular
    $sql = "SELECT id, nombre FROM categoria ORDER BY id ASC";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en la consulta SQL: " . $e->getMessage());
}
?>