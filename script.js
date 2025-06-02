// Toggle menú móvil
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.querySelector('.mobile-menu-btn');
    const menu = document.querySelector('.menu');
    btn.addEventListener('click', () => menu.classList.toggle('show'));
  });
  