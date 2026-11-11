document.addEventListener('DOMContentLoaded', () => {
  const msg = document.getElementById('msg');

  const setMessage = (text, type) => {
    if (!msg) return;
    msg.textContent = text || '';
    msg.className = type ? `msg ${type}` : 'msg';
  };

  document.querySelectorAll('form.form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
      event.preventDefault();

      const button = form.querySelector('.submit');
      if (button) button.disabled = true;
      setMessage('Please wait\u2026');

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          body: new FormData(form),
        });
        const data = await response.json();

        setMessage(data.message, data.ok ? 'ok' : 'error');

        if (data.ok && data.redirect) {
          window.location.href = data.redirect;
          return;
        }
      } catch (error) {
        setMessage('Something went wrong. Please try again.', 'error');
      } finally {
        if (button) button.disabled = false;
      }
    });
  });
});
