// ===== JAVASCRIPT DEL FOOTER SIDCO =====

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== BOTÓN VOLVER ARRIBA =====
    const backToTopButton = document.getElementById('backToTop');
    
    // Mostrar/ocultar botón según el scroll
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });
    
    // Scroll suave al hacer clic en el botón
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // ===== FORMULARIO DE NEWSLETTER =====
    const subscribeForm = document.querySelector('.subscribe-form');
    const emailInput = subscribeForm.querySelector('input[type="email"]');
    const submitButton = subscribeForm.querySelector('.btn-subscribe');
    
    // Validación del formulario
    subscribeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = emailInput.value.trim();
        
        if (validateEmail(email)) {
            // Simular envío del formulario
            submitNewsletter(email);
        } else {
            showNotification('Por favor, ingresa un email válido', 'error');
        }
    });
    
    // Validación de email en tiempo real
    emailInput.addEventListener('input', function() {
        const email = this.value.trim();
        
        if (email && !validateEmail(email)) {
            this.style.borderColor = '#ff4444';
        } else {
            this.style.borderColor = '';
        }
    });
    
    // ===== FUNCIONES DE VALIDACIÓN =====
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // ===== SIMULACIÓN DE ENVÍO DE NEWSLETTER =====
    function submitNewsletter(email) {
        // Cambiar estado del botón
        const originalText = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
        submitButton.disabled = true;
        
        // Simular delay de envío
        setTimeout(() => {
            showNotification('¡Gracias por suscribirte! Te mantendremos informado sobre nuestros proyectos.', 'success');
            
            // Resetear formulario
            subscribeForm.reset();
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        }, 2000);
    }
    
    // ===== SISTEMA DE NOTIFICACIONES =====
    function showNotification(message, type = 'info') {
        // Crear elemento de notificación
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas ${getNotificationIcon(type)}"></i>
                <span>${message}</span>
                <button class="notification-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        // Agregar estilos CSS dinámicamente
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${getNotificationColor(type)};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 400px;
        `;
        
        // Agregar al DOM
        document.body.appendChild(notification);
        
        // Animar entrada
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Botón de cerrar
        const closeButton = notification.querySelector('.notification-close');
        closeButton.addEventListener('click', () => {
            removeNotification(notification);
        });
        
        // Auto-remover después de 5 segundos
        setTimeout(() => {
            removeNotification(notification);
        }, 5000);
    }
    
    function removeNotification(notification) {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
    
    function getNotificationIcon(type) {
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };
        return icons[type] || icons.info;
    }
    
    function getNotificationColor(type) {
        const colors = {
            success: '#28a745',
            error: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
        };
        return colors[type] || colors.info;
    }
    
    // ===== ANIMACIONES DE ENTRADA =====
    function animateOnScroll() {
        const elements = document.querySelectorAll('.footer-column, .newsletter-content, .footer-separator');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });
        
        elements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }
    
    // Inicializar animaciones
    animateOnScroll();
    
    // ===== EFECTOS HOVER MEJORADOS =====
    const socialLinks = document.querySelectorAll('.social-link');
    
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.1)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // ===== ACCESIBILIDAD =====
    // Navegación por teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Cerrar notificaciones con ESC
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                removeNotification(notification);
            });
        }
    });
    
    // ===== FUNCIONES UTILITARIAS =====
    
    // Debounce para optimizar eventos de scroll
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Optimizar scroll con debounce
    const optimizedScrollHandler = debounce(function() {
        // Aquí se pueden agregar más funcionalidades de scroll
    }, 100);
    
    window.addEventListener('scroll', optimizedScrollHandler);
    
    // ===== DETECCIÓN DE REDES SOCIALES =====
    function detectSocialNetwork(url) {
        const networks = {
            'facebook.com': 'Facebook',
            'instagram.com': 'Instagram',
            'linkedin.com': 'LinkedIn',
            'youtube.com': 'YouTube',
            'whatsapp.com': 'WhatsApp'
        };
        
        for (let domain in networks) {
            if (url.includes(domain)) {
                return networks[domain];
            }
        }
        return 'Red Social';
    }
    
    // ===== TRACKING DE EVENTOS =====
    function trackEvent(eventName, data = {}) {
        // Aquí se puede integrar con Google Analytics, Facebook Pixel, etc.
        console.log('Evento SIDCO:', eventName, data);
        
        // Ejemplo de implementación con Google Analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, data);
        }
    }
    
    // Trackear clics en redes sociales
    document.querySelectorAll('.social-link').forEach(link => {
        link.addEventListener('click', function(e) {
            const network = detectSocialNetwork(this.href);
            trackEvent('social_click', {
                network: network,
                url: this.href,
                company: 'SIDCO'
            });
        });
    });
    
    // Trackear suscripciones al newsletter
    subscribeForm.addEventListener('submit', function() {
        trackEvent('newsletter_signup', {
            source: 'footer',
            company: 'SIDCO'
        });
    });
    
    // Trackear clics en enlaces de información
    document.querySelectorAll('.footer-links a').forEach(link => {
        link.addEventListener('click', function() {
            trackEvent('footer_link_click', {
                link_text: this.textContent,
                link_url: this.href,
                section: 'footer_info'
            });
        });
    });
    
    // ===== RESPONSIVE HELPERS =====
    function isMobile() {
        return window.innerWidth <= 768;
    }
    
    function isTablet() {
        return window.innerWidth > 768 && window.innerWidth <= 1024;
    }
    
    // Ajustar comportamiento según dispositivo
    window.addEventListener('resize', debounce(function() {
        if (isMobile()) {
            // Comportamientos específicos para móvil
            document.body.classList.add('mobile');
            document.body.classList.remove('tablet', 'desktop');
        } else if (isTablet()) {
            document.body.classList.add('tablet');
            document.body.classList.remove('mobile', 'desktop');
        } else {
            document.body.classList.add('desktop');
            document.body.classList.remove('mobile', 'tablet');
        }
    }, 250));
    
    // ===== FUNCIONES ESPECÍFICAS PARA CONSTRUCTORA =====
    
    // Función para mostrar información de contacto expandida
    function showContactInfo() {
        const contactItems = document.querySelectorAll('.contact-item');
        contactItems.forEach((item, index) => {
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, index * 100);
        });
    }
    
    // Función para animar el logo de la empresa
    function animateLogo() {
        const logo = document.querySelector('.brand-logo i');
        if (logo) {
            logo.style.animation = 'pulse 2s infinite';
        }
    }
    
    // Aplicar animaciones específicas
    showContactInfo();
    animateLogo();
    
    // ===== INICIALIZACIÓN FINAL =====
    console.log('Footer SIDCO Empresa Constructora inicializado correctamente');
    
    // Trackear carga de la página
    trackEvent('page_view', {
        page: 'footer',
        company: 'SIDCO',
        timestamp: new Date().toISOString()
    });
    
    // ===== ANIMACIONES CSS ADICIONALES =====
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .contact-item {
            opacity: 0;
            transform: translateX(-20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
    `;
    document.head.appendChild(style);
    
});
