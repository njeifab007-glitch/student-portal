document.addEventListener('DOMContentLoaded', () => {
    const switchButtons = document.querySelectorAll('.switch-btn');
    const panels = document.querySelectorAll('.form-panel');

    switchButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const target = button.dataset.target;

            switchButtons.forEach((btn) => btn.classList.toggle('active', btn === button));
            panels.forEach((panel) => panel.classList.toggle('active', panel.dataset.panel === target));
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const target = urlParams.get('mode');

    if (target === 'register') {
        switchButtons[1].click();
    }
});
