<?php
//llamamos la conexion a la base de datos
require_once '../../bd/conexion.php';

session_start();
$nombre = $_POST['nombre'];

try {
    $stmt = $conexion->prepare(
        "INSERT INTO categoria(nombre) VALUES(?)"
    );
    $stmt->execute([$nombre]);

    //mensaje de exito
    $_SESSION['mensaje'] = "Categoría Guardada";
    $_SESSION['tipo']    = "success";

} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Error al Guardar: " . $e->getMessage();
    $_SESSION['tipo']    = "error";
}

// volver al index.php
header("Location: ../../public/index.php");
exit;
?>