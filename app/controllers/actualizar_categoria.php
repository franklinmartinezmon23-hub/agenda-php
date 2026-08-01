<?php
// app/controllers/actualizar_categoria.php
require_once "../../bd/conexion.php";

$id     = $_POST['id'];
$nombre = $_POST['nombre'];

try {
    // Consulta preparada de actualización para la categoría
    $sql = "UPDATE categoria
            SET nombre = :nombre
            WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ':nombre' => $nombre,
        ':id'     => $id,
    ]);

    session_start();
    $_SESSION['mensaje'] = "Categoría actualizada correctamente";
    $_SESSION['tipo']    = "success";

} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['tipo']    = "error";
}

header("Location: ../../public/index.php");
exit;
?>