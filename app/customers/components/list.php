<ul class="space-y-3">
    <?php foreach ($ultimos as $c): ?>
        <li class="bg-white rounded shadow px-4 py-3 hover:bg-gray-50">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-gray-800"><?= $c['name'] . ' ' . $c['last_name'] ?></h3>
                    <p class="text-sm text-gray-600"><?= $c['phone'] ?> · <?= $c['email'] ?></p>
                </div>
                <div class="flex gap-2 text-sm">
                    <a href="customers/<?= $c['id'] ?>" class="text-blue-600 hover:underline">Ver</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>