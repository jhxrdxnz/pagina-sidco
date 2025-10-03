// Carrusel multi-imagen con imágenes visibles simultáneamente
class MultiImageCarousel {
  constructor() {
    this.carousel = document.getElementById('multiImageCarousel');
    this.items = document.querySelectorAll('.carousel-item');
    this.indicators = document.querySelectorAll('.horizontal-indicator');
    this.prevBtn = document.getElementById('multiPrevBtn');
    this.nextBtn = document.getElementById('multiNextBtn');
    this.currentIndex = 2; // Empezar con la imagen del centro (índice 2)
    this.totalItems = this.items.length;
    this.autoPlayInterval = null;
    this.autoPlayDelay = 30000; // 30 segundos
    this.isTransitioning = false;

    this.init();
  }

  init() {
    if (!this.carousel) return;

    // Event listeners para botones
    this.prevBtn?.addEventListener('click', () => this.prevSlide());
    this.nextBtn?.addEventListener('click', () => this.nextSlide());

    // Event listeners para click en imágenes
    this.items.forEach((item, index) => {
      item.addEventListener('click', () => this.goToSlide(index));
    });

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

    // Mostrar estado inicial
    this.updateCarousel();
  }

  nextSlide() {
    if (this.isTransitioning) return;
    
    this.isTransitioning = true;
    this.currentIndex = (this.currentIndex + 1) % this.totalItems;
    this.updateCarousel();
    
    // Resetear flag después de la transición
    setTimeout(() => {
      this.isTransitioning = false;
    }, 500);
  }

  prevSlide() {
    if (this.isTransitioning) return;
    
    this.isTransitioning = true;
    this.currentIndex = (this.currentIndex - 1 + this.totalItems) % this.totalItems;
    this.updateCarousel();
    
    // Resetear flag después de la transición
    setTimeout(() => {
      this.isTransitioning = false;
    }, 500);
  }

  goToSlide(index) {
    if (this.isTransitioning || index === this.currentIndex) return;
    
    this.isTransitioning = true;
    this.currentIndex = index;
    this.updateCarousel();
    
    // Resetear flag después de la transición
    setTimeout(() => {
      this.isTransitioning = false;
    }, 500);
  }

  updateCarousel() {
    // Remover clase active de todos los items
    this.items.forEach(item => item.classList.remove('active'));
    this.indicators.forEach(indicator => indicator.classList.remove('active'));

    // Agregar clase active al item actual
    if (this.items[this.currentIndex]) {
      this.items[this.currentIndex].classList.add('active');
    }
    if (this.indicators[this.currentIndex]) {
      this.indicators[this.currentIndex].classList.add('active');
    }

    // Reorganizar el orden visual para centrar la imagen activa
    this.reorderItems();
  }

  reorderItems() {
    const wrapper = this.carousel;
    const items = Array.from(this.items);
    
    // Crear un nuevo array con el orden correcto
    const reorderedItems = [];
    
    // Agregar items antes del actual
    for (let i = 1; i <= 2; i++) {
      const index = (this.currentIndex - i + this.totalItems) % this.totalItems;
      reorderedItems.unshift(items[index]);
    }
    
    // Agregar el item actual en el centro
    reorderedItems.push(items[this.currentIndex]);
    
    // Agregar items después del actual
    for (let i = 1; i <= 2; i++) {
      const index = (this.currentIndex + i) % this.totalItems;
      reorderedItems.push(items[index]);
    }
    
    // Reorganizar en el DOM
    reorderedItems.forEach(item => {
      wrapper.appendChild(item);
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
  new MultiImageCarousel();
});

// Reinicializar si hay cambios en el tema (opcional)
document.addEventListener('themeChanged', () => {
  // El carrusel se mantiene funcional independientemente del tema
  // pero podríamos agregar lógica específica si fuera necesario
});
