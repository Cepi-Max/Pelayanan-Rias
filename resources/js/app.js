import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function closeModal() {
        document.getElementById('myModal').classList.add('hidden');
    }
