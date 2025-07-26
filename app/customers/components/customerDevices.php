<?php
function getPhysicalConditionTag($pcondition)
{
    return match ($pcondition) {
        'nuevo' => 'bg-green-100 text-green-700',
        'bueno' => 'bg-blue-100 text-blue-700',
        'regular' => 'bg-yellow-100 text-yellow-700',
        'malo' => 'bg-red-100 text-red-700',
        default => 'bg-gray-100 text-gray-600'
    };
}

$deviceTabs = [
    'todos' => $devices,
    'pendientes' => array_filter($devices, fn($d) => $d['returned'] == 0),
    'entregados' => array_filter($devices, fn($d) => $d['returned'] == 1),
];
?>

<section>
    <div class="flex justify-between items-center mb-6 mt-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <!--
category: Devices
tags: [monitor, computer, imac]
version: "1.0"
unicode: "ea89"
-->
<svg
  class="w-8 h-8 text-blue-600"
  viewBox="0 0 24 24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10z" />
  <path d="M7 20h10" />
  <path d="M9 16v4" />
  <path d="M15 16v4" />
</svg>
 Equipos (<?= count($devices) ?>)
        </h1>
    </div>

    <div x-data="{ tab: 'pendientes' }" class="mt-6">
        <div class="flex space-x-2 border-b border-gray-200 text-sm mb-4">
            <?php foreach (['todos', 'pendientes', 'entregados'] as $tab): ?>
                <button @click="tab = '<?= $tab ?>'"
                    :class="tab === '<?= $tab ?>' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-600'"
                    class="px-3 py-2 border-b-2 font-medium">
                    <?= ucfirst($tab) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <?php foreach ($deviceTabs as $key => $group): ?>
            <div x-show="tab === '<?= $key ?>'" x-transition>
                <?php if (empty($group)): ?>
                    <div class="text-center text-sm text-gray-500 py-6">No hay dispositivos en esta categoría.</div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($group as $d): ?>
                            <div class="bg-white rounded-lg shadow p-4 ring-1 ring-gray-100">
                                <h3 class="text-base font-bold text-gray-800">
                                    <?= htmlspecialchars($d['brand'] . ' ' . $d['model']) ?>
                                    <span class="inline-block px-2 py-1 rounded text-xs <?= getPhysicalConditionTag($d['physical_condition']) ?>">
                                        <?= $d['physical_condition'] ?>
                                    </span>
                                </h3>
                                <p class="text-sm text-gray-600">Tipo: <?= $d['type'] ?></p>
                                <p class="text-sm text-gray-600">Serial: <?= $d['serial_number'] ?></p>
                                <p class="text-xs text-gray-500 italic"><?= $d['detailed_description'] ?? '-' ?></p>
                                <div class="flex justify-end gap-2 mt-3 text-sm">
                                    <a href="<?= route('devices/' . $d['id']) ?>" class="text-blue-600 hover:underline">Ver</a>
                                    <a href="<?= route('devices/' . $d['id'] . '/edit') ?>" class="text-yellow-600 hover:underline">Editar</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>