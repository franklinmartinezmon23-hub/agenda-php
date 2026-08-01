<?php
require_once '../../bd/conexion.php';
session_start();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$fecha = date("Y-m-d H:i:s");

$imagen = "";
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = time() . "_" . $_FILES['imagen']['name'];
    
$carpetaDestino = __DIR__ . '/../../app/assets/uploads/';

if (!file_exists($carpetaDestino)) {
    mkdir($carpetaDestino, 0777, true);
}

$rutaDestinoFisica = $carpetaDestino . $nombreArchivo;

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestinoFisica)) {
    // Guardamos esta ruta exacta en la base de datos
    $imagen = "../app/assets/uploads/" . $nombreArchivo; 
}
}

try {
    $stmt = $conexion->prepare(
        "INSERT INTO contactos(nombres, apellidos, telefono, correo, direccion, fecha_registro, imagen)
        VALUES(?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$nombre, $apellido, $telefono, $correo, $direccion, $fecha, $imagen]);

    $_SESSION['mensaje'] = "Contacto Guardado Exitosamente";
    $_SESSION['tipo'] = "success";

} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Error al Guardar: " . $e->getMessage();
    $_SESSION['tipo'] = "error";
}

header("Location: ../../public/index.php");
exit;
?>