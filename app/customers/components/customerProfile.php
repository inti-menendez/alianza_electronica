<section>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
<svg
  class="w-8 h-8 text-blue-600"
  viewBox="0 0 24 24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
</svg>
 Perfil del cliente
        </h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
            <div class="space-y-2">
                <h2 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($customer['name'] . ' ' . $customer['last_name']) ?></h2>
                <p><span class="font-medium">Teléfono:</span>
                    <a href="tel:<?= $customer['phone'] ?>" class="text-blue-600 hover:underline"><?= htmlspecialchars($customer['phone']) ?></a>
                </p>
                <p><span class="font-medium">Email:</span>
                    <a href="mailto:<?= $customer['email'] ?>" class="text-blue-600 hover:underline"><?= htmlspecialchars($customer['email'] ?? '-') ?></a>
                </p>
                <p><span class="font-medium">Dirección:</span> <?= htmlspecialchars($customer['address'] ?? '-') ?></p>
            </div>
            <div class="space-y-2">
                <p><span class="font-medium">Notas:</span>
                    <span class="block text-gray-600"><?= nl2br(htmlspecialchars($customer['notes'] ?? '-')) ?></span>
                </p>
                <p><span class="font-medium">Registrado:</span>
                    <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">
                        <?= date('d/m/Y H:i', strtotime($customer['created_at'])) ?>
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>