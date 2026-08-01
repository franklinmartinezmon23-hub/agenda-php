<?php
session_start();
// Esto apunta directo a la carpeta htdocs/agenda/app/controllers/conexion.php (si está ahí)
require_once "../../bd/conexion.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: mostrar_categoria.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM categoria WHERE id = ?");
$stmt->execute([$id]);
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$categoria) {
    $_SESSION['mensaje'] = "La categoría no existe.";
    $_SESSION['tipo'] = "error";
    header("Location: mostrar_categoria.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="../../src/output.css">
</head>

<body class="bg-slate-900 min-h-screen p-6 md:p-10 flex flex-col text-slate-100 font-sans">
    
    <!-- Encabezado y Botón de Volver -->
    <div class="max-w-4xl w-full mx-auto flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-indigo-400">Editar Categoría</h1>
        <a href="mostrar_categoria.php" class="bg-slate-800 border border-slate-700 hover:border-indigo-500/50 text-indigo-300 hover:text-indigo-200 font-semibold px-5 py-2.5 rounded-xl shadow-lg transition-all flex items-center gap-2">
            ⬅ Volver a Categorías
        </a>
    </div>

    <!-- Formulario para Editar Categoría -->
    <div class="bg-slate-800 border border-slate-700/60 max-w-4xl w-full mx-auto p-6 md:p-8 rounded-2xl shadow-2xl flex flex-col text-slate-200 mb-12">
        <!-- Si tu archivo que procesa la actualización (actualizar_categoria.php) lo tienes en controllers -->
        <form action="../controllers/actualizar_categoria.php" method="post" class="w-full space-y-5 flex flex-col">
            <p class="bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 rounded-xl p-3 uppercase font-bold text-center tracking-wide text-sm">Modificar Categoría</p>
            
            <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']); ?>">

            <div>
                <label for="nombre" class="block text-sm font-semibold mb-2 text-slate-300">Nombre de la Categoría:</label>
                <input type="text" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" name="nombre" id="nombre" value="<?= htmlspecialchars($categoria['nombre']); ?>" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">Actualizar Categoría</button>
        </form>
    </div>

</body>

</html>