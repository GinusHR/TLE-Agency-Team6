import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.querySelector('.navbar-dropdown');
    const menuIcon = dropdown.querySelector('.menu-icon');

    menuIcon.addEventListener('click', function () {
        // Toggle de 'active' klasse op de .navbar-dropdown
        dropdown.classList.toggle('active');
    });
});
