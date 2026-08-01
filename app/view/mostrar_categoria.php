<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link rel="stylesheet" href="../../src/output.css">
</head>

<body class="bg-slate-900 min-h-screen p-6 md:p-10 flex flex-col text-slate-100 font-sans">
    <!-- mensaje -->
    <?php
    session_start();

    if (isset($_SESSION['mensaje'])): ?>

        <div class="max-w-4xl mx-auto w-full mb-6 p-4 rounded-xl text-center font-medium shadow-lg
        <?php echo $_SESSION['tipo'] == "success"
            ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400'
            : 'bg-rose-500/10 border border-rose-500/30 text-rose-400'; ?>">
            <?php echo $_SESSION['mensaje']; ?>
        </div>

    <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo']);
    endif; ?>

    <!-- Encabezado y Botón de Volver -->
    <div class="max-w-4xl w-full mx-auto flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-indigo-400">Gestión de Categorías</h1>
        <a href="../../public/index.php" class="bg-slate-800 border border-slate-700 hover:border-indigo-500/50 text-indigo-300 hover:text-indigo-200 font-semibold px-5 py-2.5 rounded-xl shadow-lg transition-all flex items-center gap-2">
            ⬅ Volver al Inicio
        </a>
    </div>

    <!-- Formulario para Guardar Categoría -->
    <div class="bg-slate-800 border border-slate-700/60 max-w-4xl w-full mx-auto p-6 md:p-8 rounded-2xl shadow-2xl flex flex-col text-slate-200 mb-12">
        <form action="../controllers/guardar_categoria.php" method="post" class="w-full space-y-5 flex flex-col">
            <p class="bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 rounded-xl p-3 uppercase font-bold text-center tracking-wide text-sm">Nueva Categoría</p>
            
            <div>
                <label for="nombre" class="block text-sm font-semibold mb-2 text-slate-300">Nombre de la Categoría:</label>
                <input type="text" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" name="nombre" id="nombre" required>
            </div>

            <!-- Botón guardar -->
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">Guardar Categoría</button>
        </form>
    </div>

    <!-- Listado de Categorías -->
    <div class="max-w-4xl mx-auto rounded-2xl text-center w-full">
        <h2 class="text-2xl md:text-3xl p-4 font-extrabold text-slate-200 uppercase tracking-wide mb-6">Listado de Categorías</h2>

        <?php require_once "../controllers/listar_categoria.php"; ?>

        <?php if (empty($categorias)): ?>
            <p class="bg-slate-800 border border-slate-700 p-6 rounded-xl font-medium text-slate-400 max-w-md mx-auto">No Hay Categorías Registradas</p>
        <?php else: ?>
            <div class="overflow-x-auto shadow-2xl rounded-2xl border border-slate-800">
                <table class="w-full text-center border-collapse">
                    <thead class="bg-slate-800 text-slate-200 uppercase text-xs tracking-wider border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 font-bold">Id</th>
                            <th class="px-6 py-4 font-bold">Nombre</th>
                            <th class="px-6 py-4 font-bold">Gestión de Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 bg-slate-900/80 text-slate-300 text-sm">
                        <?php foreach ($categorias as $cat): ?>
                            <tr class="hover:bg-slate-800/50 transition-colors">
                                <td class="p-4 font-semibold text-slate-400"><?= htmlspecialchars($cat['id']); ?></td>
                                <td class="p-4 font-medium text-slate-100"><?= htmlspecialchars($cat['nombre']); ?></td>
                                <!-- Sección de acciones -->
                                <td class="p-4 space-x-2">
                                    <a href="editar_categoria.php?id=<?= $cat['id'] ?>" class="inline-block bg-sky-500/10 border border-sky-500/30 text-sky-400 hover:bg-sky-500 hover:text-white px-3 py-1.5 rounded-lg font-medium transition-all text-xs">Editar</a>
                                    <a href="../controllers/eliminar_categoria.php?id=<?= $cat['id'] ?>" class="inline-block bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white px-3 py-1.5 rounded-lg font-medium transition-all text-xs" onclick="return confirm('¿Está seguro de eliminar esta categoría?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>