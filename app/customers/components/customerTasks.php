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
    <div class="bg-white rounded-lg shadow p-4">
        <div class="bg-white flex space-x-2 border-b border-gray-200 text-sm mb-4">
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
                <div class="bg-white border-l-4 border-blue-400 rounded-lg ring-1 ring-gray-100">
                    <div class="flex justify-between items-center bg-gray-50 px-4 py-2 rounded-t relative">
                        <h3 class="text-sm font-semibold text-gray-800" x-text="t.title"></h3>

                        <span
                            class=" text-xs font-semibold px-2 py-1 rounded"
                            :class="{
                        'bg-red-100 text-red-800': t.priority === 'alta',
                        'bg-yellow-100 text-yellow-800': t.priority === 'media',
                        'bg-green-100 text-green-800': t.priority === 'baja'
                        }"
                            x-text="`${t.priority} • ${t.estimated_date}`">
                        </span>

                    </div>
                    <div class="p-4">

                        <p class="text-sm text-gray-600 mb-2" x-text="t.description"></p>



                        <div class="text-xs text-gray-500 mb-1">
                            <span class="font-medium text-gray-700">Equipo:</span>
                            <span x-text="`${t.device?.brand ?? '-'} ${t.device?.model ?? '-'}`"></span>
                            <span class="text-gray-400">•</span>
                            <span x-text="`Serial: ${t.device?.serial_number ?? '-'}`"></span>
                        </div>

                        <div class="text-xs text-gray-500 mb-1">
                            <span class="font-medium text-gray-700">Técnico:</span>
                            <span x-text="`${t.technician?.name ?? 'Sin asignar'} ${t.technician?.last_name ?? ''}`"></span>
                        </div>
                        <div class="flex justify-between items-center gap-2 mt-3 text-sm">
                            <div class="">
                                <span :class="statusClass(t.status)" class="text-xs px-2 py-1 rounded font-semibold">
                                    <span x-text="statusLabel(t.status)"></span>
                                </span>
                            </div>
                            <div>
                            <a :href="`<?= route('tasks/') ?>${t.id}`" class="text-blue-600 hover:underline">Ver</a>
                            <a :href="`<?= route('tasks/') ?>${t.id}/edit`" class="text-yellow-600 hover:underline">Editar</a>
                            </div>
                        </div>
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
            },
            statusLabel(status) {
                return {
                    pendiente: 'Pendiente',
                    en_proceso: 'En proceso',
                    diagnosticado: 'Diagnosticado',
                    espera_repuesto: 'Espera repuesto',
                    espera_insumos: 'Espera insumos',
                    espera_respuesta_del_cliente: 'Espera respuesta',
                    completada: 'Completada',
                    entregada: 'Entregada',
                    cancelada: 'Cancelada'
                } [status] ?? 'Desconocido';
            },
            statusClass(status) {
                return {
                    pendiente: 'bg-yellow-100 text-yellow-800',
                    en_proceso: 'bg-blue-100 text-blue-800',
                    diagnosticado: 'bg-indigo-100 text-indigo-800',
                    espera_repuesto: 'bg-orange-100 text-orange-800',
                    espera_insumos: 'bg-orange-100 text-orange-800',
                    espera_respuesta_del_cliente: 'bg-pink-100 text-pink-800',
                    completada: 'bg-green-100 text-green-800',
                    entregada: 'bg-green-200 text-green-900',
                    cancelada: 'bg-red-100 text-red-800'
                } [status] ?? 'bg-gray-100 text-gray-800';
            }
        };
    }
</script>