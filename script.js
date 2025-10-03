document.addEventListener('DOMContentLoaded', () => {
    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');

    const performSearch = () => {
        const searchTerm = searchInput.value.trim();
        if (searchTerm) {
            alert('Búsqueda: ' + searchTerm);
        } else {
            alert('Por favor, ingrese un término de búsqueda.');
        }
    };

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    searchBtn.addEventListener('click', performSearch);

    // Mobile Navigation Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        const isExpanded = navLinks.classList.contains('active');
        menuToggle.setAttribute('aria-expanded', isExpanded);
    });

    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', false);
            }
        });
    });

    // Load more functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    const secondaryGrid = document.querySelector('.secondary-grid');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            this.classList.add('loading');
            this.disabled = true;
            setTimeout(() => {
                for (let i = 0; i < 3; i++) {
                    const article = document.createElement('article');
                    article.className = 'secondary-article';
                    article.setAttribute('itemscope', '');
                    article.setAttribute('itemtype', 'https://schema.org/NewsArticle');
                    
                    const randomTitle = `Nueva noticia de sociedad ${Math.floor(Math.random() * 1000)}`;
                    const randomHours = Math.floor(Math.random() * 12) + 1;

                    article.innerHTML = `
                        <meta itemprop="headline" content="${randomTitle}">
                        <meta itemprop="datePublished" content="${new Date().toISOString()}">
                        <div class="secondary-image">
                            <img src="https://via.placeholder.com/350x200/f3e5f5/e1bee7?text=Noticia+Adicional" alt="Imagen de noticia adicional" itemprop="image">
                        </div>
                        <div class="secondary-content">
                            <h3 class="secondary-title" itemprop="name">${randomTitle}</h3>
                            <p class="secondary-summary" itemprop="description">Contenido adicional sobre temas sociales relevantes para la comunidad argentina.</p>
                            <div class="article-meta">
                                <time datetime="PT${randomHours}H">Hace ${randomHours} horas</time>
                            </div>
                        </div>
                    `;
                    secondaryGrid.appendChild(article);
                }
                this.classList.remove('loading');
                this.disabled = false;
            }, 1500);
        });
    }

    // Article hover animations
    document.querySelectorAll('.featured-article, .secondary-article').forEach(article => {
        article.addEventListener('mouseenter', function() {
        });
        
        article.addEventListener('mouseleave', function() {
        });
    });

    // Dark mode toggle
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }

    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', toggleDarkMode);
    }
});

