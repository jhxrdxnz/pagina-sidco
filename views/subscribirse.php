<!-- Suscribite: Modal con overlay -->
<style>
  /* Overlay modal con efecto vidrio */
  .subscribe-overlay {
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.28);
    backdrop-filter: blur(8px) saturate(120%);
    -webkit-backdrop-filter: blur(8px) saturate(120%);
    opacity: 0;
    visibility: hidden;
    transition: opacity .25s ease, visibility .25s ease;
    z-index: 10000;
    padding: 20px;
  }
  .subscribe-overlay.is-open { opacity: 1; visibility: visible; }

  .subscribe-modal {
    position: relative;
    width: 100%;
    max-width: 760px;
  }
  .modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 36px;
    height: 36px;
    border-radius: 999px;
    border: 1px solid var(--border-color);
    background: rgba(255,255,255,0.65);
    color: #111111;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: filter .2s ease;
  }
  .modal-close:hover { filter: brightness(0.95); }
  [data-theme="dark"] .modal-close { background: rgba(17,17,17,0.6); color: #ffffff; }

  .suscribite-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 32px;
  }
  .suscribite-card {
    width: 100%;
    max-width: 640px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
    padding: 32px;
    border: 1px solid var(--border-color);
  }
  [data-theme="dark"] .suscribite-card { background: #0f0f10; }
  .suscribite-card h2 {
    margin: 0 0 16px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 26px;
    color: #1f2937;
  }
  [data-theme="dark"] .suscribite-card h2 { color: var(--text-color); }
  .suscribite-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }
  .suscribite-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #4b5563;
    font-size: 14px;
    user-select: none;
  }
  .suscribite-checkbox input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin: 0;
  }
  .suscribite-button {
    background: linear-gradient(90deg, #6366f1, #3b82f6);
    color: #ffffff;
    border: 0;
    border-radius: 10px;
    padding: 12px 16px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: filter .2s ease, transform .05s ease;
  }
  .suscribite-button:hover { filter: brightness(0.95); }
  .suscribite-button:active { transform: scale(0.98); }
  .suscribite-legal { text-align: center; margin-top: 10px; }
  .suscribite-legal a { color: #6b7280; font-size: 12px; text-decoration: none; }
  .suscribite-legal a:hover { text-decoration: underline; }
  [data-theme="dark"] .suscribite-legal a { color: var(--text-light); }

  /* Estilo de input flotante que te gustó */
  .inputGroup {
    font-family: 'Segoe UI', sans-serif;
    margin: 8px 0 8px 0;
    position: relative;
  }
  .inputGroup input {
    font-size: 18px;
    padding: 14px;
    outline: none;
    border: 2px solid rgb(200, 200, 200);
    background-color: transparent;
    border-radius: 24px;
    width: 100%;
  }
  [data-theme="dark"] .inputGroup input {
    color: #ffffff;
    caret-color: #ffffff;
  }
  [data-theme="dark"] .inputGroup input::placeholder {
    color: rgba(255,255,255,0.75);
  }
  .inputGroup label {
    font-size: 15px;
    position: absolute;
    left: 0;
    padding: 14px;
    margin-left: 10px;
    pointer-events: none;
    transition: all 0.3s ease;
    color: rgb(100, 100, 100);
  }
  [data-theme="dark"] .inputGroup label { color: rgba(255,255,255,0.75); }
  .inputGroup :is(input:focus, input:valid) ~ label {
    transform: translateY(-50%) scale(.9);
    margin: 0;
    margin-left: 22px;
    padding: 8px 10px;
    background-color: #e8e8e8;
    border-radius: 10px;
  }
  [data-theme="dark"] .inputGroup :is(input:focus, input:valid) ~ label {
    background-color: #1f2937;
    color: #ffffff;
  }
  .inputGroup :is(input:focus, input:valid) {
    border-color: rgb(150, 150, 200);
  }

  /* Toggle términos y condiciones (sin Tailwind) */
  .sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 1px, 1px);
    white-space: nowrap;
    border: 0;
  }
  .toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #4b5563;
    font-size: 16px;
    user-select: none;
  }
  .toggle-track {
    position: relative;
    width: 96px;
    height: 48px;
    background: #f87171; /* rojo */
    border-radius: 999px;
    transition: background 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
  }
  .toggle-track::after {
    content: '✖️';
    position: absolute;
    top: 4px;
    left: 4px;
    width: 40px;
    height: 40px;
    background: #f9fafb;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transform: rotate(-180deg);
    transition: left 0.3s ease, transform 0.3s ease;
  }
  .toggle-input:checked + .toggle-track {
    background: #10b981; /* verde */
  }
  .toggle-input:checked + .toggle-track::after {
    left: 52px;
    transform: rotate(0deg);
    content: '✔️';
  }

  /* Botón SVG de términos (scoped para evitar choque con .container global) */
  .terms-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
  }
  .terms-text {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #4b5563;
    font-size: 16px;
  }
  [data-theme="dark"] .terms-text { color: var(--text-light); }
  .terms-control {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
  }
  .terms-control input {
    display: none;
  }
  .terms-control svg {
    overflow: visible;
    width: 2em; height: 2em;
  }
  .terms-path {
    fill: none;
    stroke: currentColor;
    stroke-width: 6;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: stroke-dasharray 0.5s ease, stroke-dashoffset 0.5s ease;
    stroke-dasharray: 241 9999999;
    stroke-dashoffset: 0;
  }
  .terms-control input:checked ~ svg .terms-path {
    stroke-dasharray: 70.5096664428711 9999999;
    stroke-dashoffset: -262.2723388671875;
  }
  .terms-control { color: #111111; }
  [data-theme="dark"] .terms-control { color: #ffffff; }
</style>

<div id="subscribeOverlay" class="subscribe-overlay" aria-hidden="true" role="dialog" aria-modal="true">
  <div class="subscribe-modal">
    <button type="button" id="subscribeClose" class="modal-close" aria-label="Cerrar">✕</button>
    <div class="suscribite-container">
      <div class="suscribite-card">
        <h2>Suscribite</h2>
        <form id="subscribeForm" class="suscribite-form" method="post" action="/Pagina/views/enviar-suscripcion.php" novalidate>
          <div class="inputGroup">
            <input id="nombre" name="nombre" type="text" required autocomplete="off">
            <label for="nombre">Nombre</label>
          </div>
          <div class="inputGroup">
            <input id="email" name="email" type="email" required autocomplete="off">
            <label for="email">Email</label>
          </div>
          <div class="terms-row">
            <span class="terms-text">Acepto los términos y condiciones</span>
            <label class="terms-control" for="terminos" aria-label="Aceptar términos y condiciones">
              <input id="terminos" type="checkbox" name="terminos" required>
              <svg viewBox="0 0 64 64" aria-hidden="true">
                <path d="M 0 16 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 16 L 32 48 L 64 16 V 8 A 8 8 90 0 0 56 0 H 8 A 8 8 90 0 0 0 8 V 56 A 8 8 90 0 0 8 64 H 56 A 8 8 90 0 0 64 56 V 16" pathLength="575.0541381835938" class="terms-path"></path>
              </svg>
            </label>
          </div>
          <button type="submit" class="suscribite-button">Suscribirse</button>
        </form>
        <div class="suscribite-legal">
          <a href="#">Política de privacidad</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    const overlay = document.getElementById('subscribeOverlay');
    const closeBtn = document.getElementById('subscribeClose');
    const form = document.getElementById('subscribeForm');

    function openModal() {
      overlay.classList.add('is-open');
      overlay.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      // foco en el primer campo
      const first = form?.querySelector('input');
      setTimeout(() => first && first.focus(), 60);
    }
    function closeModal() {
      overlay.classList.remove('is-open');
      overlay.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }
    window.openSubscribeModal = openModal;

    // Cerrar con X y clic fuera
    closeBtn?.addEventListener('click', closeModal);
    overlay?.addEventListener('click', (e) => {
      if (e.target === overlay) closeModal();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });

    // Interceptar clics en enlaces de Suscribirse (header/footer)
    document.addEventListener('click', function(e) {
      const a = e.target.closest && e.target.closest('a');
      if (!a) return;
      const href = a.getAttribute('href') || '';
      if (/suscribirse/i.test(href)) {
        e.preventDefault();
        openModal();
      }
    });

    // Validación simple
    form?.addEventListener('submit', function(e) {
      const nombre = form.nombre?.value.trim();
      const email = form.email?.value.trim();
      const terminos = form.terminos?.checked;
      if (!nombre || !email || !terminos) {
        e.preventDefault();
        alert('Completá nombre, email y aceptá términos para continuar.');
        return false;
      }
      // Aquí podrías hacer fetch a tu endpoint y cerrar el modal
      // closeModal();
    });
  })();
</script>