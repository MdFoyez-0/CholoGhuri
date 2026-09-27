document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form[data-confirm]');
    
    forms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!confirm(form.dataset.confirm)) {
                event.preventDefault();
            }
        });
    });

    const searchInput = document.querySelector('#packageSearch');
    
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            
            document.querySelectorAll('.package-card').forEach(card => {
                const text = card.innerText.toLowerCase();
                card.style.display = text.includes(query) ? 'block' : 'none';
            });
        });
    }
});
