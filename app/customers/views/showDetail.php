<?php
$customer = $data['customer'];
$devices = $data['devices'];
$tasks = $data['tasks'];
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        [icon]
        Perfil del cliente
    </h1>
</div>
    <?php include __DIR__ . '/../components/CustomerProfile.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        [icon]
        equipos del cliente
    </h1>
</div>
<?php include __DIR__ . '/../components/CustomerDevices.php'; ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        [icon]
        Tareas asociadas
    </h1>
</div>
<?php include __DIR__ . '/../components/CustomerTasks.php'; ?>

