document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('searchInput');
    const allClients = window.clientesData || [];

    input?.addEventListener('input', () => {
        const q = input.value.toLowerCase();

        const filtrados = allClients.filter(c =>
            (`${c.name} ${c.last_name}`.toLowerCase().includes(q)) ||
            (c.phone ?? '').toLowerCase().includes(q) ||
            (c.email ?? '').toLowerCase().includes(q)
        );

        renderCards(filtrados);
        renderTable(filtrados);
    });

    renderCards(allClients);
    renderTable(allClients);
});

function renderCards(clientes) {
    const cardContainer = document.querySelector('#cardContainer');
    if (!cardContainer) return;

    cardContainer.innerHTML = '';

    if (clientes.length === 0) {
        cardContainer.innerHTML = `<div class="text-center text-gray-500 py-6">No se encontraron resultados.</div>`;
        return;
    }

    clientes.forEach(c => {
        const card = document.createElement('div');
        card.className = "bg-white rounded-lg shadow p-4 flex flex-col justify-between hover:ring-1 hover:ring-blue-300 transition";

        card.innerHTML = `
            <div>
                <h2 class="text-lg font-bold text-gray-800">${c.name} ${c.last_name}</h2>
                <p class="text-sm text-gray-600">${c.phone}</p>
                <p class="text-sm text-gray-600">${c.email ?? '-'}</p>
                <p class="text-xs text-gray-500 line-clamp-2">${c.notes ?? '-'}</p>
            </div>
            <div class="flex justify-end gap-2 mt-4 text-sm">
                <a href="/customers/${c.id}" class="text-blue-600 hover:underline">Ver</a>
                <a href="/customers/${c.id}/edit" class="text-yellow-600 hover:underline">Editar</a>
                <a href="/customers/${c.id}/delete" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </div>
        `;
        cardContainer.appendChild(card);
    });
}

function renderTable(clientes) {
    const container = document.querySelector('#tableContainer');
    if (!container) return;

    container.innerHTML = '';

    if (clientes.length === 0) {
        container.innerHTML = `<div class="text-center text-gray-500 py-6">No se encontraron resultados.</div>`;
        return;
    }

    let html = `
      
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Teléfono</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Dirección</th>
                    <th class="px-4 py-2 text-left">Notas</th>
                    <th class="px-4 py-2 text-left">Creado</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
    `;

    clientes.forEach((c, i) => {
        html += `
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 text-gray-500">${i + 1}</td>
                <td class="px-4 py-2 text-gray-800 font-medium">${c.name} ${c.last_name}</td>
                <td class="px-4 py-2 text-gray-600">${c.phone}</td>
                <td class="px-4 py-2 text-gray-600">${c.email ?? '-'}</td>
                <td class="px-4 py-2 text-gray-600">${c.address ?? '-'}</td>
                <td class="px-4 py-2 text-gray-500 italic line-clamp-2">${c.notes ?? '-'}</td>
                <td class="px-4 py-2 text-gray-500 text-xs">
                    ${new Date(c.created_at).toLocaleString('es-VE')}
                </td>
                <td class="px-4 py-2">
                    <div class="flex gap-2 text-sm">
                        <a href="/customers/${c.id}" class="text-blue-600 hover:underline">Ver</a>
                        <a href="/customers/${c.id}/edit" class="text-yellow-600 hover:underline">Editar</a>
                        <a href="/customers/${c.id}/delete" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar cliente?')">Eliminar</a>
                    </div>
                </td>
            </tr>
        `;
    });

    html += `</tbody></table>`;
    container.innerHTML = html;
}