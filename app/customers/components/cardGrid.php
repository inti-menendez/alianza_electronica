<div id="cardContainer"
    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($clientes as $c): ?>
        <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between hover:ring-1 hover:ring-blue-300 transition">
            <div>
                <h2 class="text-lg font-bold text-gray-800"><?= $c['name'] . ' ' . $c['last_name'] ?></h2>
                <p class="text-sm text-gray-600"><?= $c['phone'] ?></p>
                <p class="text-sm text-gray-600"><?= $c['email'] ?></p>
                <p class="text-xs text-gray-500 line-clamp-2"><?= $c['notes'] ?? '-' ?></p>
            </div>
            <div class="flex justify-end gap-2 mt-4 text-sm">
                <a href="/customers/<?= $c['id'] ?>" class="text-blue-600 hover:underline">Ver</a>
                <a href="/customers/<?= $c['id'] ?>/edit" class="text-yellow-600 hover:underline">Editar</a>
                <a href="/customers/<?= $c['id'] ?>/delete" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>