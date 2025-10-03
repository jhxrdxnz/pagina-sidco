// Establecer el tema lo antes posible (antes del DOMContentLoaded)
(function initThemeEarly() {
  try {
    const root = document.documentElement;
    const saved = localStorage.getItem('theme');
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initial = saved || (prefersDark ? 'dark' : 'light');
    if (root.getAttribute('data-theme') !== initial) {
      root.setAttribute('data-theme', initial);
    }
  } catch (_) {
    // noop
  }
})();

window.addEventListener('scroll', function() {
  const header = document.getElementById('header');
  if (window.scrollY > 50) { 
    header.classList.add('scrolled'); // se fija y se superpone
  } else {
    header.classList.remove('scrolled'); // vuelve a ocupar su espacio
  }
});

// Toggle de tema claro/oscuro con persistencia
document.addEventListener('DOMContentLoaded', function() {
  const root = document.documentElement;
  const checkbox = document.getElementById('themeCheckbox');

  const saved = localStorage.getItem('theme');
  const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initial = saved || (prefersDark ? 'dark' : 'light');
  root.setAttribute('data-theme', initial === 'dark' ? 'dark' : 'light');
  if (checkbox) checkbox.checked = initial === 'dark';

  checkbox?.addEventListener('change', () => {
    const next = checkbox.checked ? 'dark' : 'light';
    root.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
  });

  // Abrir modal Suscribite desde el header
  document.querySelectorAll('a.open-subscribe').forEach((link) => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      if (typeof window.openSubscribeModal === 'function') {
        window.openSubscribeModal();
      } else {
        // fallback: buscar overlay e intentar abrir
        const overlay = document.getElementById('subscribeOverlay');
        if (overlay) {
          overlay.classList.add('is-open');
          overlay.setAttribute('aria-hidden', 'false');
          document.body.style.overflow = 'hidden';
        }
      }
    });
  });
});