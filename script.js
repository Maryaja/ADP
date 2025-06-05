document.addEventListener('DOMContentLoaded', () => {
    // --- Toggle menú móvil ---
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const menu = document.querySelector('.menu');

    if (mobileMenuBtn && menu) { // Añadir una verificación para asegurar que los elementos existen
        mobileMenuBtn.addEventListener('click', () => {
            menu.classList.toggle('show');
        });
    }

    // --- Funcionalidad de los servicios (mostrar/ocultar detalles) ---
    const categoryListItems = document.querySelectorAll('.service-category-list li');
    const detailSections = document.querySelectorAll('.service-detail-section');

    // Función para ocultar todas las secciones de detalles
    const hideAllDetailSections = () => {
        detailSections.forEach(section => {
            section.classList.remove('active');
        });
    };

    // Función para mostrar una sección específica
    const showDetailSection = (targetId) => {
        hideAllDetailSections();
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.classList.add('active');
        }
    };

    // Ocultar todas las secciones al cargar la página (opcional, para empezar sin ninguna visible)
    hideAllDetailSections();

    // Event listener para cada elemento de la lista de categorías
    categoryListItems.forEach(item => {
        item.addEventListener('click', () => {
            const targetId = item.getAttribute('data-target');
            showDetailSection(targetId);
        });
    });

    // Opcional: Mostrar la primera sección por defecto al cargar la página si hay categorías
    if (categoryListItems.length > 0) {
        const firstTargetId = categoryListItems[0].getAttribute('data-target');
        showDetailSection(firstTargetId);
    }
});