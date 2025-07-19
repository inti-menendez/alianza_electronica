<?php
$ultimos = array_slice($clientes, 0, 3);
?>
<h2 class="text-xl font-bold text-gray-800 mb-4">Últimos clientes registrados</h2>
<?php include __DIR__ . '/../components/list.php'; ?>


<div class="flex justify-between items-center mt-8 mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
        </svg>
        Clientes registrados (<?= count($clientes) ?>)

    </h1>

    <a href="/customers/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
        + Agregar Cliente
    </a>
</div>

<div x-data="{ tab: 'cards' }" class="mb-6">
    <div class="flex border-b border-gray-200 space-x-4">
        <button @click="tab = 'cards'" :class="tab === 'cards' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-600'"
            class="py-2 px-3 border-b-2 text-sm font-medium transition hover:text-blue-600">
            🧩 Tarjetas
        </button>
        <button @click="tab = 'table'" :class="tab === 'table' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-600'"
            class="py-2 px-3 border-b-2 text-sm font-medium transition hover:text-blue-600">
            📊 Tabla
        </button>
        <input type="text" id="searchInput"
            placeholder="Buscar cliente por nombre, teléfono o email..."
            class="w-full md:max-w-lg px-3 py-2 border rounded shadow text-sm focus:outline-none focus:ring focus:border-blue-300" />

    </div>

    <div class="mt-6">
        <div x-show="tab === 'cards'" x-transition>
            <?php include __DIR__ . '/../components/CardGrid.php'; ?>
        </div>
        <div x-show="tab === 'table'" x-transition>
            <?php include __DIR__ . '/../components/table.php'; ?>
        </div>
    </div>

</div>
<script>
    window.clientesData = <?= json_encode($clientes) ?>;
</script>