document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
    feather.replace();

    const slides = document.querySelectorAll('.timeline-slide');
    const points = document.querySelectorAll('.timeline-point');
    const progress = document.querySelector('.timeline-progress');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentIndex = 0;
    const totalSlides = slides.length;

    // Update timeline
    function updateTimeline(index) {
        // Update slides
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
            }
        });

        // Update points
        points.forEach((point, i) => {
            point.classList.remove('active');
            if (i === index) {
                point.classList.add('active');
            }
        });

        // Update progress
        const progressWidth = (index / (totalSlides - 1)) * 100;
        progress.style.width = `${progressWidth}%`;
    }

    // Next slide
    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateTimeline(currentIndex);
    }

    // Previous slide
    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateTimeline(currentIndex);
    }

    // Event listeners
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    // Point click events
    points.forEach((point, index) => {
        point.addEventListener('click', () => {
            currentIndex = index;
            updateTimeline(currentIndex);
        });
    });

    // Auto-advance (optional)
    let autoSlide = setInterval(nextSlide, 5000);

    // Pause on hover
    const timelineContainer = document.querySelector('section[aria-label="Línea de tiempo de obras"]');
    if (timelineContainer) {
        timelineContainer.addEventListener('mouseenter', () => {
            clearInterval(autoSlide);
        });
        timelineContainer.addEventListener('mouseleave', () => {
            autoSlide = setInterval(nextSlide, 5000);
        });
    }
});