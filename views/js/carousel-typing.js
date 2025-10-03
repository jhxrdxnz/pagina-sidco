document.addEventListener("DOMContentLoaded", function() {
  const carouselEl = document.getElementById('carouselCrossfade');
  const typingSpeed = 50; // ms por letra
  const intervalTime = 2000; // 2s por slide
  let autoSlideTimeout;
  let inactivityTimer;

  // Esperar a que una imagen esté completamente cargada
  function waitForImage(img) {
    return new Promise(resolve => {
      if (img.complete) resolve();
      else img.onload = () => resolve();
    });
  }

  // Auto-typing
  function typeText(element) {
    return new Promise(resolve => {
      const text = element.getAttribute('data-text');
      element.textContent = '';
      let i = 0;
      const timer = setInterval(() => {
        element.textContent += text[i];
        i++;
        if (i >= text.length) {
          clearInterval(timer);
          resolve();
        }
      }, typingSpeed);
    });
  }

  async function handleSlide(item) {
    const img = item.querySelector('img');
    await waitForImage(img); // esperar que la imagen cargue

    const texts = item.querySelectorAll('.typing-text');
    for (const el of texts) {
      await typeText(el);
    }

    // Iniciar temporizador de auto-slide
    startAutoSlide();
  }

  function startAutoSlide() {
    clearTimeout(autoSlideTimeout);
    autoSlideTimeout = setTimeout(() => {
      const bsCarousel = bootstrap.Carousel.getInstance(carouselEl);
      bsCarousel.next();
    }, intervalTime);
  }

  function resetInactivityTimer() {
    clearTimeout(inactivityTimer);
    inactivityTimer = setTimeout(() => {
      startAutoSlide();
    }, 6000); // 6s sin mover mouse
  }

  // Iniciar primer slide
  handleSlide(carouselEl.querySelector('.carousel-item.active'));

  // Pausar y reanudar auto-slide al mover el mouse
  carouselEl.addEventListener('mouseenter', () => clearTimeout(autoSlideTimeout));
  carouselEl.addEventListener('mousemove', resetInactivityTimer);

  // Evento de cambio de slide
  carouselEl.addEventListener('slid.bs.carousel', async function(e) {
    const nextItem = e.relatedTarget;
    // Limpiar cualquier timer previo
    clearTimeout(autoSlideTimeout);
    // Reiniciar typing
    const texts = nextItem.querySelectorAll('.typing-text');
    texts.forEach(el => el.textContent = '');
    await handleSlide(nextItem);
  });
});