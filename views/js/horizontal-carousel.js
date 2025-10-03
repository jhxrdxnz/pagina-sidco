// Carrusel horizontal de proyectos
class HorizontalCarousel {
  constructor() {
    this.carousel = document.getElementById('horizontalCarousel');
    this.slides = document.querySelectorAll('.horizontal-slide');
    this.indicators = document.querySelectorAll('.horizontal-indicator');
    this.prevBtn = document.getElementById('horizontalPrevBtn');
    this.nextBtn = document.getElementById('horizontalNextBtn');
    this.currentSlide = 0;
    this.totalSlides = this.slides.length;
    this.autoPlayInterval = null;
    this.autoPlayDelay = 30000; // 30 segundos como solicitado
    this.isTransitioning = false;

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

    // Event listeners para touch/swipe en móviles
    this.addTouchEvents();

    // Iniciar autoplay
    this.startAutoPlay();

    // Mostrar slide inicial
    this.updateSlide();
  }

  nextSlide() {
    if (this.isTransitioning) return;
    
    this.isTransitioning = true;
    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
    this.updateSlide();
    
    // Resetear flag después de la transición
    setTimeout(() => {
      this.isTransitioning = false;
    }, 800);
  }

  prevSlide() {
    if (this.isTransitioning) return;
    
    this.isTransitioning = true;
    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
    this.updateSlide();
    
    // Resetear flag después de la transición
    setTimeout(() => {
      this.isTransitioning = false;
    }, 800);
  }

  goToSlide(index) {
    if (this.isTransitioning || index === this.currentSlide) return;
    
    this.isTransitioning = true;
    this.currentSlide = index;
    this.updateSlide();
    
    // Resetear flag después de la transición
    setTimeout(() => {
      this.isTransitioning = false;
    }, 800);
  }

  updateSlide() {
    // Calcular el desplazamiento
    const translateX = -this.currentSlide * 100;
    this.carousel.style.transform = `translateX(${translateX}%)`;

    // Actualizar indicadores
    this.indicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === this.currentSlide);
    });
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

  addTouchEvents() {
    let startX = 0;
    let endX = 0;
    let isDragging = false;

    this.carousel.addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
      isDragging = true;
      this.pauseAutoPlay();
    });

    this.carousel.addEventListener('touchmove', (e) => {
      if (!isDragging) return;
      e.preventDefault();
    });

    this.carousel.addEventListener('touchend', (e) => {
      if (!isDragging) return;
      
      endX = e.changedTouches[0].clientX;
      const diffX = startX - endX;
      const threshold = 50; // Mínimo de píxeles para activar el swipe

      if (Math.abs(diffX) > threshold) {
        if (diffX > 0) {
          this.nextSlide();
        } else {
          this.prevSlide();
        }
      }

      isDragging = false;
      this.startAutoPlay();
    });
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

  // Método para cambiar el tiempo de autoplay
  setAutoPlayDelay(delay) {
    this.autoPlayDelay = delay;
    if (this.autoPlayInterval) {
      this.restart();
    }
  }
}

// Inicializar carrusel cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  new HorizontalCarousel();
});

// Reinicializar si hay cambios en el tema (opcional)
document.addEventListener('themeChanged', () => {
  // El carrusel se mantiene funcional independientemente del tema
  // pero podríamos agregar lógica específica si fuera necesario
});
