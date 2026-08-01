<?php
require_once '../../bd/conexion.php';
session_start();

$id = $_GET['id'];

try {
    // 1. Buscar el contacto para obtener el nombre de la imagen
    $stmt = $conexion->prepare("SELECT imagen FROM contactos WHERE id = ?");
    $stmt->execute([$id]);
    $contacto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$contacto) {
        throw new Exception("El contacto no existe.");
    }

    // 2. Eliminar el registro de la base de datos
    $stmtDelete = $conexion->prepare("DELETE FROM contactos WHERE id = ?");
    $stmtDelete->execute([$id]);

    // 3. Eliminar la imagen física del servidor (si existe)
    if (!empty($contacto['imagen'])) {
        $rutaImagen = $contacto['imagen'];
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    }

    $_SESSION['mensaje'] = "Contacto eliminado correctamente.";
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