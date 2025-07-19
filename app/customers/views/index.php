<?php
$ultimos = array_slice($clientes, 0, 3); 
?>

<h2 class="text-xl font-bold text-gray-800 mb-4">Últimos clientes registrados</h2>
<?php include __DIR__ . '/../components/list.php'; ?>

<h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">Clientes Registrados</h2>

<div x-data="{ tab: 'cards' }" class="mb-6">
    <div class="flex border-b border-gray-200 space-x-4">
        <button @click="tab = 'cards'" :class="{ 'border-blue-600 text-blue-600': tab === 'cards' }"
            class="py-2 px-3 border-b-2 text-sm font-medium text-gray-600 hover:text-blue-600">
            🧩 Vista de tarjetas
        </button>

        <button @click="tab = 'table'" :class="{ 'border-blue-600 text-blue-600': tab === 'table' }"
            class="py-2 px-3 border-b-2 text-sm font-medium text-gray-600 hover:text-blue-600">
            📊 Vista de tabla
        </button>
    </div>

    <div class="mt-4">
        <div x-show="tab === 'cards'">
            <?php include __DIR__ . '/../components/cardGrid.php'; ?>
        </div>
        <div x-show="tab === 'table'">
            <?php include __DIR__ . '/../components/table.php'; ?>
        </div>
    </div>
</div>