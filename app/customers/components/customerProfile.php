<div class="bg-white rounded-lg shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
        <div>
            <p><span class="font-semibold">Nombre:</span> <?= htmlspecialchars($customer['name'] . ' ' . $customer['last_name']) ?></p>
            <p><span class="font-semibold">Teléfono:</span> <?= htmlspecialchars($customer['phone']) ?></p>
            <p><span class="font-semibold">Email:</span> <?= htmlspecialchars($customer['email'] ?? '-') ?></p>
            <p><span class="font-semibold">Dirección:</span> <?= htmlspecialchars($customer['address'] ?? '-') ?></p>
        </div>
        <div>
            <p><span class="font-semibold">Notas:</span> <?= nl2br(htmlspecialchars($customer['notes'] ?? '-')) ?></p>
            <p><span class="font-semibold">Registrado:</span> <?= date('d/m/Y H:i', strtotime($customer['created_at'])) ?></p>
        </div>
    </div>
</div>