<?php
// app/controllers/actualizar.php
require_once "../../bd/conexion.php";

$id               = $_POST['id'];
$nombres          = $_POST['nombre'];
$apellidos        = $_POST['apellido'];
$telefono         = $_POST['telefono'];
$correo           = $_POST['correo'];
$direccion        = $_POST['direccion'];
$nombre_categoria = $_POST['nombre_categoria']; // Recibimos el nombre de la categoría
$imagenActual     = $_POST['imagen_actual'] ?? null; // Ruta de la imagen actual

$imagen = $imagenActual; // Valor por defecto si no sube otra imagen

try {

    // Si seleccionó una nueva imagen
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){

       $nombreArchivo = time() . "_" . $_FILES['imagen']['name'];

       // Carpeta física donde se guardará
        $carpeta = "../assets/uploads/";
        $ruta = $carpeta . $nombreArchivo;

        // Mover imagen nueva
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)){

            // eliminar imagen anterior
            if(!empty($_POST['imagen_actual'])){

                $imagenAnterior = $_POST['imagen_actual'];

                if(file_exists($imagenAnterior)){
                    unlink($imagenAnterior);
                }
            }

            // guardar nuevo nombre
            $imagen = $ruta;

        }

    }

// Consulta preparada de actualización incluyendo nombre_categoria
$sql = "UPDATE contactos
        SET nombres = :nombres, 
            apellidos = :apellidos, 
            telefono = :telefono,
            correo = :correo, 
            direccion = :direccion, 
            nombre_categoria = :nombre_categoria,
            imagen = :imagen
        WHERE id = :id";

$stmt = $conexion->prepare($sql);

$stmt->execute([
  ':nombres'          => $nombres,
  ':apellidos'        => $apellidos,
  ':telefono'         => $telefono,
  ':correo'           => $correo,
  ':direccion'        => $direccion,
  ':nombre_categoria' => $nombre_categoria,
  ':imagen'           => $imagen,
  ':id'               => $id,
]);
    session_start();
  $_SESSION['mensaje']="Contacto actualizado correctamente";
    $_SESSION['tipo']="success";

}catch(PDOException $e){

    $_SESSION['mensaje']="Error: ".$e->getMessage();
    $_SESSION['tipo']="error";

}

header("Location: ../../public/index.php");
exit;

?>