<?php
require_once '../../bd/conexion.php';
session_start();

$id = $_GET['id'];

try {
    // 1. Verificar si la categoría existe
    $stmt = $conexion->prepare("SELECT id FROM categoria WHERE id = ?");
    $stmt->execute([$id]);
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        throw new Exception("La categoría no existe.");
    }

    // 2. Eliminar el registro de la base de datos
    $stmtDelete = $conexion->prepare("DELETE FROM categoria WHERE id = ?");
    $stmtDelete->execute([$id]);

    $_SESSION['mensaje'] = "Categoría eliminada correctamente.";
    $_SESSION['tipo'] = "success";

} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Error al eliminar: " . $e->getMessage();
    $_SESSION['tipo'] = "error";
} catch (Exception $e) {
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['tipo'] = "error";
}

header("Location: ../../public/index.php");
exit;
?>