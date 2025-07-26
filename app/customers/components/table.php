<table id="tableContainer" class="overflow-x-auto min-w-full divide-y divide-gray-200 text-sm">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">#</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Nombre</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Teléfono</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Email</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Dirección</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Notas</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Creado</th>
            <th class="px-4 py-2 text-left text-gray-700 font-semibold">Acciones</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        <?php foreach ($clientes as $i => $c): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 text-gray-500"><?= $i + 1 ?></td>
                <td class="px-4 py-2 text-gray-800 font-medium"><?= htmlspecialchars($c['name'] . ' ' . $c['last_name']) ?></td>
                <td class="px-4 py-2 text-gray-600"><?= htmlspecialchars($c['phone']) ?></td>
                <td class="px-4 py-2 text-gray-600"><?= htmlspecialchars($c['email'] ?? '-') ?></td>
                <td class="px-4 py-2 text-gray-600"><?= htmlspecialchars($c['address'] ?? '-') ?></td>
                <td class="px-4 py-2 text-gray-500 italic line-clamp-2 max-w-xs"><?= htmlspecialchars($c['notes'] ?? '-') ?></td>
                <td class="px-4 py-2 text-gray-500 text-xs">
                    <?= date('d/m/Y H:i', strtotime($c['created_at'])) ?>
                </td>
                <td class="px-4 py-2">
                    <div class="flex gap-2 text-sm">
                        <a href="customers/<?= $c['id'] ?>" class="text-blue-600 hover:underline">Ver</a>
                        <a href="customers/<?= $c['id'] ?>/edit" class="text-yellow-600 hover:underline">Editar</a>
                        <a href="customers/<?= $c['id'] ?>/delete" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar cliente?')">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>