import { showError, showSuccess } from './alerts.js';

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form[data-auto]').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();

      const url = form.getAttribute('action');
      const method = form.getAttribute('method') || 'POST';
      const redirect = form.dataset.redirect || null;
      const target = form.dataset.alert || '#form-alert';

      const data = new FormData(form);

      fetch(url, { method, body: data })
        .then(res => res.json())
        .then(response => {
          if (response.success) {
            showSuccess(response.message || 'Operación exitosa', target);
            if (redirect) window.location.href = redirect;
          }else {
            showError(response.message || 'Algo salió mal', target);
          }
        })
        .catch(err => {
          console.error(err);
          showError('Error de conexión con el servidor', target);
        });
    });
  });
});