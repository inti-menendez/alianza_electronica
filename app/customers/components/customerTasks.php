<h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">Tareas Asociadas</h2>
<table class="min-w-full divide-y divide-gray-200 text-sm bg-white rounded-lg shadow ring-1 ring-gray-100">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left">Título</th>
            <th class="px-4 py-2 text-left">Estado</th>
            <th class="px-4 py-2 text-left">Prioridad</th>
            <th class="px-4 py-2 text-left">Fecha estimada</th>
            <th class="px-4 py-2 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        <?php foreach ($tasks as $t): ?>
            <tr>
                <td class="px-4 py-2"><?= htmlspecialchars($t['title']) ?></td>
                <td class="px-4 py-2"><?= $t['status'] ?></td>
                <td class="px-4 py-2"><?= $t['priority'] ?></td>
                <td class="px-4 py-2"><?= $t['estimated_date'] ?></td>
                <td class="px-4 py-2">
                    <a href="<?= route('tasks/' . $t['id']) ?>" class="text-blue-600 hover:underline">Ver</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>