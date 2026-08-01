<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Agenda con PHP</title>
    <link rel="stylesheet" href="../src/output.css">
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

    <!-- Encabezado Principal -->
    <div class="max-w-4xl w-full mx-auto mb-8 text-center sm:text-left">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-indigo-400">CRUD de Agenda con PHP</h1>
    </div>

    <!-- Formulario -->
    <div class="bg-slate-800 border border-slate-700/60 max-w-4xl w-full mx-auto p-6 md:p-8 rounded-2xl shadow-2xl flex flex-col text-slate-200 mb-12">
        <form action="../app/controllers/guardar.php" method="post" class="w-full space-y-5 flex flex-col" enctype="multipart/form-data">
            <p class="bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 rounded-xl p-3 uppercase font-bold text-center tracking-wide text-sm">Formulario Contactos</p>
            
            <div>
                <label for="nombre" class="block text-sm font-semibold mb-2 text-slate-300">Nombres:</label>
                <input type="text" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" name="nombre" id="nombre" required>
            </div>

            <div>
                <label for="apellido" class="block text-sm font-semibold mb-2 text-slate-300">Apellidos:</label>
                <input type="text" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" name="apellido" id="apellido" required>
            </div>

            <div>
                <label for="telefono" class="block text-sm font-semibold mb-2 text-slate-300">Teléfono:</label>
                <input type="text" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" name="telefono" id="telefono" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold mb-2 text-slate-300">Correo electrónico:</label>
                <input type="email" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" name="correo" id="email" required>
            </div>

            <div>
                <label for="direccion" class="block text-sm font-semibold mb-2 text-slate-300">Dirección:</label>
                <textarea class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none h-24" name="direccion" id="direccion" required></textarea>
            </div>

            <!-- Selector de Categoría (Dinámico con PHP y enlace a Nueva Categoría) -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="categoria" class="block text-sm font-semibold text-slate-300">Categoría:</label>
                    <a href="../app/view/mostrar_categoria.php" class="text-xs text-indigo-400 hover:text-indigo-300 underline font-medium transition-colors">
                        + Nueva Categoría
                    </a>
                </div>

                <?php require_once "../app/controllers/listar_categoria.php"; ?>

                <select name="nombre_categoria" id="categoria" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer" required>
                    <option value="" disabled selected>Seleccione una categoría</option>
                    <?php 
                        if (!empty($categorias)) {
                            foreach ($categorias as $cat) {
                                echo '<option value="' . htmlspecialchars($cat['nombre']) . '">' . htmlspecialchars($cat['nombre']) . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <!-- Archivo -->
            <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-700 hover:border-indigo-500/50 p-6 rounded-xl cursor-pointer bg-slate-900/50 hover:bg-slate-900 transition-all">
                <label for="imagen" class="block w-full text-center text-sm font-semibold mb-2 text-slate-300 cursor-pointer">Imagen de Perfil:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 cursor-pointer" required>
            </div>

            <!-- Botón guardar -->
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">Guardar Contacto</button>
        </form>
    </div>

    <!-- Listado -->
    <div class="max-w-7xl mx-auto rounded-2xl text-center w-full">
        <h2 class="text-3xl md:text-4xl p-4 font-extrabold text-slate-200 uppercase tracking-wide mb-6">Listado de Contactos</h2>

        <?php require_once "../app/controllers/listar.php"; ?>

        <?php if (empty($contactos)): ?>
            <p class="bg-slate-800 border border-slate-700 p-6 rounded-xl font-medium text-slate-400 max-w-md mx-auto">No Hay Contactos Registrados</p>
        <?php else: ?>
            <div class="overflow-x-auto shadow-2xl rounded-2xl border border-slate-800">
                <table class="w-full text-center border-collapse">
                    <thead class="bg-slate-800 text-slate-200 uppercase text-xs tracking-wider border-b border-slate-700">
                        <tr>
                            <th class="px-4 py-4 font-bold">Id</th>
                            <th class="px-4 py-4 font-bold">Imagen</th>
                            <th class="px-4 py-4 font-bold">Nombres</th>
                            <th class="px-4 py-4 font-bold">Apellidos</th>
                            <th class="px-4 py-4 font-bold">Telefono</th>
                            <th class="px-4 py-4 font-bold">Correo</th>
                            <th class="px-4 py-4 font-bold">Direccion</th>
                            <th class="px-4 py-4 font-bold">Categoría</th>
                            <th class="px-4 py-4 font-bold">Fecha Registro</th>
                            <th class="px-4 py-4 font-bold">Gestion de Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 bg-slate-900/80 text-slate-300 text-sm">
                        <?php foreach ($contactos as $c): ?>
                            <tr class="hover:bg-slate-800/50 transition-colors">
                                <td class="p-4 font-semibold text-slate-400"><?= htmlspecialchars($c['id']); ?></td>
                                <td class="p-4">
                                    <?php if (!empty($c['imagen'])): ?>
                                        <img src="../app/assets/<?= htmlspecialchars($c['imagen']); ?>" class="w-12 h-12 object-cover rounded-full mx-auto ring-2 ring-indigo-500/40 shadow-md">
                                    <?php else: ?>
                                        <span class="text-slate-500 text-xs italic">Sin foto</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 font-medium text-slate-100"><?= htmlspecialchars($c['nombres']); ?></td>
                                <td class="p-4"><?= htmlspecialchars($c['apellidos']); ?></td>
                                <td class="p-4"><?= htmlspecialchars($c['telefono']); ?></td>
                                <td class="p-4 text-indigo-300"><?= htmlspecialchars($c['correo']); ?></td>
                                <td class="p-4 text-slate-400"><?= htmlspecialchars($c['direccion']); ?></td>
                                <td class="p-4">
                                    <span class="bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        <?= htmlspecialchars($c['nombre_categoria'] ?? 'Sin categoría'); ?>
                                    </span>
                                </td>
                                <td class="p-4 text-slate-400 text-xs"><?= htmlspecialchars($c['fecha_registro']); ?></td>
                                <td class="p-4 space-x-2">
                                    <a href="../app/view/editar.php?id=<?= $c['id'] ?>" class="inline-block bg-sky-500/10 border border-sky-500/30 text-sky-400 hover:bg-sky-500 hover:text-white px-3 py-1.5 rounded-lg font-medium transition-all text-xs">Editar</a>
                                    <a href="../app/controllers/eliminar.php?id=<?= $c['id'] ?>" class="inline-block bg-rose-500/10 border border-rose-500/30 text-rose-400 hover:bg-rose-500 hover:text-white px-3 py-1.5 rounded-lg font-medium transition-all text-xs" onclick="return confirm('¿Está seguro de eliminar este contacto?')">Eliminar</a>
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