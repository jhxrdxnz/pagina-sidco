// Carrusel con ciclo infinito y vista previa
class CycleCarousel {
  constructor() {
    this.carousel = document.getElementById('cycleCarousel');
    this.items = document.querySelectorAll('.cycle-item');
    this.dataItems = document.querySelectorAll('.cycle-data-item');
    this.indicators = document.querySelectorAll('.horizontal-indicator');
    this.prevBtn = document.getElementById('cyclePrevBtn');
    this.nextBtn = document.getElementById('cycleNextBtn');
    this.currentIndex = 0;
    this.totalItems = this.dataItems.length;
    this.autoPlayInterval = null;
    this.autoPlayDelay = 5000; // 5 segundos
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
      item.addEventListener('click', () => this.handleItemClick(item));
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
    // Ciclo circular: cuando llega al final, vuelve al inicio
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
    // Ciclo circular: cuando está en el inicio, va al final
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

  handleItemClick(item) {
    const itemIndex = parseInt(item.dataset.index);
    if (itemIndex !== this.currentIndex) {
      this.goToSlide(itemIndex);
    }
  }

  updateCarousel() {
    // Calcular índices para las 3 imágenes visibles
    const prevIndex = (this.currentIndex - 1 + this.totalItems) % this.totalItems;
    const nextIndex = (this.currentIndex + 1) % this.totalItems;
    
    // Obtener elementos de datos
    const prevData = this.dataItems[prevIndex];
    const currentData = this.dataItems[this.currentIndex];
    const nextData = this.dataItems[nextIndex];
    
    // Crear efecto de deslizamiento
    this.createSlideEffect(prevData, currentData, nextData);

    // Actualizar indicadores
    this.indicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === this.currentIndex);
    });
  }

  createSlideEffect(prevData, currentData, nextData) {
    const direction = this.getSlideDirection();
    
    // Aplicar animación de deslizamiento
    this.updateItemContent(this.items[0], prevData, 'cycle-item-prev', direction);
    this.updateItemContent(this.items[1], currentData, 'cycle-item-active', direction);
    this.updateItemContent(this.items[2], nextData, 'cycle-item-next', direction);
  }

  getSlideDirection() {
    if (this.previousIndex === undefined) {
      this.previousIndex = this.currentIndex;
      return 'next';
    }
    
    const direction = this.currentIndex > this.previousIndex ? 'next' : 'prev';
    this.previousIndex = this.currentIndex;
    return direction;
  }

  updateItemContent(item, data, className, direction = 'next') {
    // Determinar la clase de animación
    const animationClass = direction === 'next' ? 'slide-left' : 'slide-right';
    
    // Actualizar clases con animación
    item.className = `cycle-item ${className} ${animationClass}`;
    item.dataset.index = data.dataset.index;
    
    // Actualizar imagen
    const image = item.querySelector('.cycle-image');
    image.style.backgroundImage = `url('${data.dataset.image}')`;
    image.setAttribute('aria-label', data.dataset.title);
    
    // Actualizar texto
    const title = item.querySelector('.cycle-text h3');
    const description = item.querySelector('.cycle-text p');
    title.textContent = data.dataset.title;
    description.textContent = data.dataset.description;
    
    // Limpiar la clase de animación después de que termine
    setTimeout(() => {
      item.classList.remove('slide-left', 'slide-right');
    }, 600);
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

    // Agregar eventos de touch a cada item individual
    this.items.forEach(item => {
      item.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isDragging = true;
        this.pauseAutoPlay();
      });

      item.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
      });

      item.addEventListener('touchend', (e) => {
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
        } else {
          // Si no hay swipe, manejar como click
          this.handleItemClick(item);
        }

        isDragging = false;
        this.startAutoPlay();
      });
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
  new CycleCarousel();
});

// Reinicializar si hay cambios en el tema (opcional)
document.addEventListener('themeChanged', () => {
  // El carrusel se mantiene funcional independientemente del tema
  // pero podríamos agregar lógica específica si fuera necesario
});
