<?php
require_once '../../bd/conexion.php';
session_start();

$id = $_GET['id'] ?? null;

$stmt = $conexion->prepare("SELECT * FROM contactos WHERE id = ?");
$stmt->execute([$id]);
$contacto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contacto) {
    $_SESSION['mensaje'] = "El contacto no existe.";
    $_SESSION['tipo'] = "error";
    header("Location: ../../public/index.php");
    exit;
}

// Requerimos el controlador que carga las categorías para el <select>
require_once "../controllers/listar_categoria.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg overflow-hidden">

        <div class="bg-cyan-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Editar Contacto</h2>
        </div>

        <form action="../controllers/actualizar.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            <input type="hidden" name="id" value="<?php echo $contacto['id']; ?>">
            <input type="hidden" name="imagen_actual" value="<?php echo $contacto['imagen']; ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($contacto['nombres']); ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($contacto['apellidos']); ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($contacto['telefono']); ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                <input type="email" name="correo" value="<?php echo htmlspecialchars($contacto['correo']); ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text" name="direccion" value="<?php echo htmlspecialchars($contacto['direccion']); ?>"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600">
            </div>

            <!-- Selector de Categoría Añadido -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select name="nombre_categoria" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-600" required>
                    <option value="" disabled>Seleccione una categoría</option>
                    <?php 
                        if (!empty($categorias)) {
                            foreach ($categorias as $cat) {
                                $selected = ($contacto['nombre_categoria'] == $cat['nombre']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($cat['nombre']) . '" ' . $selected . '>' . htmlspecialchars($cat['nombre']) . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <?php if ($contacto['imagen']): ?>
            <div>
                <p class="text-sm font-medium text-gray-700 mb-1">Imagen actual:</p>
                <img src="<?php echo $contacto['imagen']; ?>"
                    class="w-24 h-24 object-cover rounded-lg border border-gray-300">
            </div>
            <?php endif; ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cambiar imagen (opcional)</label>
                <input type="file" name="imagen" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-cyan-600 file:text-white file:cursor-pointer hover:file:bg-cyan-700">
            </div>

            <button type="submit"
                class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-2.5 rounded-lg transition-colors">
                Actualizar
            </button>
        </form>
    </div>

</body>
</html>