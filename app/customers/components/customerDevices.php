<h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">Dispositivos Registrados</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($devices as $device): ?>
        <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
            <h3 class="font-semibold text-gray-800"><?= htmlspecialchars($device['brand'] . ' ' . $device['model']) ?></h3>
            <p class="text-sm text-gray-600">Tipo: <?= $device['type'] ?></p>
            <p class="text-sm text-gray-600">Serial: <?= $device['serial_number'] ?></p>
            <p class="text-sm text-gray-600">Condición: <?= $device['physical_condition'] ?></p>
            <p class="text-xs text-gray-500 italic"><?= htmlspecialchars($device['detailed_description'] ?? '-') ?></p>
        </div>
    <?php endforeach; ?>
</div>