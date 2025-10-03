// Carrusel de imágenes del section features
class FeaturesImageCarousel {
  constructor() {
    this.carousel = document.getElementById('featuresImageCarousel');
    this.slides = document.querySelectorAll('.features-carousel-slide');
    this.indicators = document.querySelectorAll('.features-indicator');
    this.prevBtn = document.getElementById('featuresPrevBtn');
    this.nextBtn = document.getElementById('featuresNextBtn');
    this.currentSlide = 0;
    this.totalSlides = this.slides.length;
    this.autoPlayInterval = null;
    this.autoPlayDelay = 4000; // 4 segundos

    this.init();
  }

  init() {
    if (!this.carousel) return;

    // Event listeners para botones
    this.prevBtn?.addEventListener('click', () => this.prevSlide());
    this.nextBtn?.addEventListener('click', () => this.nextSlide());

    // Event listeners para indicadores
    this.indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => this.goToSlide(index));
    });

    // Event listeners para teclado
    document.addEventListener('keydown', (e) => this.handleKeydown(e));

    // Event listeners para hover (pausar autoplay)
    this.carousel.addEventListener('mouseenter', () => this.pauseAutoPlay());
    this.carousel.addEventListener('mouseleave', () => this.startAutoPlay());

    // Iniciar autoplay
    this.startAutoPlay();

    // Mostrar slide inicial
    this.updateSlide();
  }

  nextSlide() {
    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
    this.updateSlide();
  }

  prevSlide() {
    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
    this.updateSlide();
  }

  goToSlide(index) {
    this.currentSlide = index;
    this.updateSlide();
  }

  updateSlide() {
    // Remover clase active de todos los slides
    this.slides.forEach(slide => slide.classList.remove('active'));
    this.indicators.forEach(indicator => indicator.classList.remove('active'));

    // Agregar clase active al slide actual
    if (this.slides[this.currentSlide]) {
      this.slides[this.currentSlide].classList.add('active');
    }
    if (this.indicators[this.currentSlide]) {
      this.indicators[this.currentSlide].classList.add('active');
    }
  }

  handleKeydown(e) {
    // Solo manejar flechas si el carrusel está visible
    if (!this.isCarouselVisible()) return;

    switch(e.key) {
      case 'ArrowLeft':
        e.preventDefault();
        this.prevSlide();
        break;
      case 'ArrowRight':
        e.preventDefault();
        this.nextSlide();
        break;
    }
  }

  isCarouselVisible() {
    const rect = this.carousel.getBoundingClientRect();
    return rect.top < window.innerHeight && rect.bottom > 0;
  }

  startAutoPlay() {
    this.pauseAutoPlay(); // Limpiar intervalo existente
    this.autoPlayInterval = setInterval(() => {
      this.nextSlide();
    }, this.autoPlayDelay);
  }

  pauseAutoPlay() {
    if (this.autoPlayInterval) {
      clearInterval(this.autoPlayInterval);
      this.autoPlayInterval = null;
    }
  }

  // Método público para reiniciar autoplay si es necesario
  restart() {
    this.startAutoPlay();
  }
}

// Inicializar carrusel cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  new FeaturesImageCarousel();
});

// Reinicializar si hay cambios en el tema (opcional)
document.addEventListener('themeChanged', () => {
  // El carrusel se mantiene funcional independientemente del tema
  // pero podríamos agregar lógica específica si fuera necesario
});
