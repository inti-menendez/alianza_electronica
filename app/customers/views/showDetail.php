<?php
$customer = $data['customer'];
$devices = $data['devices'];
$tasks = $data['tasks'];
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">

        <?php include __DIR__ . '/../components/CustomerProfile.php'; ?>

        <?php include __DIR__ . '/../components/CustomerDevices.php'; ?>

    </div>

    <aside class="space-y-4">
        <section >
            <?php include __DIR__ . '/../components/customerTasks.php'; ?>
        </section>
    </aside>
</div>