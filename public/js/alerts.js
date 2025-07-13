export function showSuccess(msg) {
    //toast de tailwind

    const toast = document.createElement('div');
    toast.className = 'fixed top-5 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded shadow-lg flex items-center space-x-2 animate-fade-in-down';
    toast.innerHTML = `
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m2.586-7.414a2 2 0 00-2.828 0l-10 10a2 2 0 000 2.828l10 10a2 2 0 002.828 0l10-10a2 2 0 000-2.828l-10-10z"/>
        </svg>
        <span>${msg}</span>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

export function showError(msg) {
    //toast de tailwind

    const toast = document.createElement('div');
    toast.className = 'fixed top-5 right-5 z-50 bg-red-500 text-white px-6 py-3 rounded shadow-lg flex items-center space-x-2 animate-fade-in-down';
    toast.innerHTML = `
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span>${msg}</span>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}