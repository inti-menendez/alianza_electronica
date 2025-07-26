<script>
    window.tasksData = <?= json_encode($tasks) ?>;
</script>

<div x-data="taskTabs()">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg
                class="w-8 h-8 text-blue-600"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M13 5h8" />
                <path d="M13 9h5" />
                <path d="M13 15h8" />
                <path d="M13 19h5" />
                <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            </svg>
            Tareas asociadas (<?= count($tasks) ?>)
        </h1>
    </div>


    <div class="flex space-x-2 border-b border-gray-200 text-sm mb-4">
        <template x-for="tab in tabs" :key="tab">
            <button @click="active = tab"
                :class="active === tab ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-600'"
                class="px-3 py-2 border-b-2 font-medium"
                x-text="tabLabel(tab)">
            </button>
        </template>
    </div>


    <div class="space-y-4">
        <template x-for="t in filtered" :key="t.id">
            <div class="bg-white rounded-lg shadow p-4 ring-1 ring-gray-100">
                <h3 class="text-base font-bold text-gray-800" x-text="t.title"></h3>
                <p class="text-sm text-gray-600" x-text="t.description"></p>
                <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                    <span>Estado: <strong class="text-gray-700" x-text="t.status"></strong></span>
                    <span>Prioridad: <span x-text="t.priority"></span></span>
                    <span>Fecha estimada: <span x-text="t.estimated_date"></span></span>
                </div>
                <div class="flex justify-end gap-2 mt-3 text-sm">
                    <a :href="`<?= route('tasks/') ?>${t.id}`" class="text-blue-600 hover:underline">Ver</a>
                    <a :href="`<?= route('tasks/') ?>${t.id}/edit`" class="text-yellow-600 hover:underline">Editar</a>
                </div>
            </div>
        </template>
        <template x-if="filtered.length === 0">
            <div class="text-center text-sm text-gray-500 py-6">
                No hay tareas en esta categoría.
            </div>
        </template>

    </div>
</div>


<script>
    function taskTabs() {
        return {
            tasks: window.tasksData || [],
            active: 'pendientes',
            tabs: ['todas', 'pendientes', 'completadas'],
            get filtered() {
                if (this.active === 'todas') return this.tasks;
                if (this.active === 'pendientes') return this.tasks.filter(t => t.status !== 'completada');
                if (this.active === 'completadas') return this.tasks.filter(t => t.status === 'completada');
                return [];
            },
            tabLabel(tab) {
                return {
                    todas: 'Todas',
                    pendientes: 'Pendientes',
                    completadas: 'Completadas'
                } [tab];
            }
        };
    }
</script>