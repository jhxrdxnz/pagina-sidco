
        // Datos de ejemplo
        const projects = [
            {
                id: 1,
                title: "El Milord",
                location: "Pilará Country, Buenos Aires",
                category: "network",
                description: "Complete renovation of the historic Plaza de Mayo including pavement, lighting and green areas.",
                coords: [-34.46197264416397, -58.95159188995362]
            },
            {
                id: 2,
                title: "Pavimentacion Bocacalle",
                location: "Pilará Country, Buenos Aires",
                category: "infrastructure",
                description: "Paving and upgrading of side streets in residential neighborhoods.",
                coords: [-34.46197264416397, -58.95159188995362]
            },
            {
                id: 3,
                title: "El Cabriolet y Tilbury Norte",
                location: "Pilará Country, Buenos Aires",
                category: "network",
                description: "10km extension of Highway 9 to improve connectivity with northern suburbs.",
                coords: [-34.46197264416397, -58.95159188995362]
            },
            {
                id: 4,
                title: "Tilbury Sur",
                location: "Pilará Country, Buenos Aires",
                category: "network",
                description: "Development and beautification of Puerto Madero waterfront area.",
                coords: [-34.46197264416397, -58.95159188995362]
            },
            {
                id: 5,
                title: "Metrobus Corrientes",
                location: "Av. Corrientes, Buenos Aires",
                category: "infrastructure",
                description: "Implementation of a BRT system along Corrientes Avenue.",
                coords: [-34.6036, -58.3839]
            },
            {
                id: 6,
                title: "Las Moradas",
                location: "Las Moradas, Buenos Aires",
                category: "network",
                description: "Installation of city-wide WiFi network in downtown Buenos Aires.",
                coords: [-34.57826145918516, -58.68429285344798]
            },
            {
                id: 7,
                title: "San Telmo Street Repair",
                location: "San Telmo, Buenos Aires",
                category: "civil",
                description: "Complete street repair and underground utilities update in San Telmo.",
                coords: [-34.6189, -58.3722]
            },
            {
                id: 8,
                title: "Subway Line A Renovation",
                location: "Retiro, Buenos Aires",
                category: "infrastructure",
                description: "Modernization of the oldest subway line in Latin America.",
                coords: [-34.5919, -58.3750]
            },
            {
                id: 9,
                title: "Altos de San Carlos",
                location: "Altos de San Carlos",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.481068075413546, -58.68446754417762] 
            },
            {
                id: 10,
                title: "Hospital Precoz",
                location: "Pablo Nogués",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.49606766342554, -58.70900488729057] 
            },
            {
                id: 11,
                title: "CDI Barrio Rincón de Tortuguitas",
                location: "Jose C. Paz",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.496191090443, -58.79237317421484] 
            },
            {
                id: 12,
                title: "Ejercito del Norte",
                location: "Grand Bourg",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.48996058926846, -58.72098120762572] 
            },
            {
                id: 13,
                title: "Ruka Tigre",
                location: "Tigre",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.43638987505673, -58.59400084026638] 
            },
            {
                id: 14,
                title: "Bailen",
                location: "Pablo Nogués",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.48639374358002, -58.69236357660423] 
            },
            {
                id: 15,
                title: "Av. Bernardo Ader",
                location: "Munro",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.53512640858076, -58.54101478322916] 
            },
            {
                id: 16,
                title: "San Calal",
                location: "Adolfo Sourdeaux",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.50702254149437, -58.6588079134177] 
            },
            {
                id: 17,
                title: "El Primaveral",
                location: "Grand Bourg",
                category: "network",
                description: "Renovacion del gasoducto del establecimiento",
                coords: [-34.466900440354685, -58.72354174410911] 
            }
        ];

        // Declarar variables de mapa y marcadores en un ámbito accesible por todas las funciones
        let map;
        let markers;
        const projectMarkers = {};

        const categoryFolderMap = {
            civil: 'Civiles',
            network: 'Redes',
            infrastructure: 'Infra'
        };


        // Función auxiliar: crea íconos personalizados de Leaflet con número y categoría
        function createCustomIcon(category, id) {
            return L.divIcon({
                className: '',
                html: `<div class="number-icon ${category}">${id}</div>`,
                iconSize: [28, 28],
                iconAnchor: [14, 14]
            });
        }

        // Función auxiliar: construye la URL del proyecto (basado en convención)
        function getProjectUrl(project) {
            if (project.url) return project.url;
            if (project.title === 'El Milord') return 'views/Obras/obra-1.php';
            return `views/Obras/obra-${project.id}.php`;
        }

        // Función auxiliar: obtiene la imagen principal (hero) para cada proyecto (escalable por reglas)
        function getProjectHero(project) {
            const DEFAULT_IMG = 'https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/632c7061-4e31-490d-96ab-a37bedd6140f.png';

            const toSlug = (str) => (str || '')
                .toLowerCase()
                .normalize('NFD').replace(/\p{Diacritic}/gu, '')
                .replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');

            const slug = toSlug(project.title || '');
            const category = project.category || 'uncategorized';

            // Obtenemos el nombre real de la carpeta
            const folder = categoryFolderMap[category] || 'otros';

            const RULES = [
                { test: () => !!slug, image: () => `views/Obras/images/${folder}/${slug}/hero.jpg` },
                { test: () => !!slug, image: () => `views/Obras/images/${folder}/${slug}/hero.png` },
            ];

            for (const rule of RULES) {
                try {
                    if (rule.test(project)) {
                        const img = typeof rule.image === 'function' ? rule.image(project) : rule.image;
                        return img;
                    }
                } catch (_) {}
            }

            return DEFAULT_IMG;
        }

        // Función auxiliar: construye el contenido HTML del popup del proyecto
        function createPopupContent(project) {
            const categoryClass = `popup-${project.category}`;
            const url = getProjectUrl(project);
            return `
                <div class=\"popup-inner\">
                    <span class=\"popup-category ${categoryClass}\">${getCategoryName(project.category)}</span>
                    <img class=\"popup-thumb\" src=\"${getProjectHero(project)}\" alt=\"${project.title} preview\" />
                    <h3 class=\"popup-title\">${project.title}</h3>
                    <div class=\"popup-actions\">
                        <a href=\"${url}\" class=\"cta-button ${categoryClass} open-details\" data-url=\"${url}\" aria-label=\"Ver detalles de ${project.title}\">Ver Detalles</a>
                    </div>
                </div>
            `;
        }

        // Función auxiliar: devuelve el nombre visible de la categoría
        function getCategoryName(category) {
            switch(category) {
                case 'civil': return 'Civil';
                case 'network': return 'Redes';
                case 'infrastructure': return 'Infraestructura';
                default: return '';
            }
        }

        // Renderiza los proyectos en la barra lateral con filtrado por categoría
        function renderProjects(category = 'all') {
            // Contenedor donde se insertarán las tarjetas de proyectos
            const container = document.getElementById('projectsContainer');
            container.innerHTML = '';
            
            // Determinar proyectos a mostrar según la categoría
            const filteredProjects = category === 'all' 
                ? projects 
                : projects.filter(p => p.category === category);
            
            filteredProjects.forEach(project => {
                // Crear tarjeta de proyecto con clases y atributos de datos
                const projectElement = document.createElement('div');
                projectElement.className = `project-card project-${project.category}`;
                projectElement.dataset.projectId = project.id;
                
                projectElement.innerHTML = `
                    <!-- Miniatura del proyecto -->
                    <div class="project-thumb-wrapper">
                        <img class="project-thumb" src="${getProjectHero(project)}" 
                             alt="${project.title} Preview">
                    </div>
                    <div class="project-info">
                        <!-- Información básica del proyecto -->
                        <h3 class="project-title">${project.title}</h3>
                        <p class="project-location">${project.location}</p>
                        <p class="project-description">${project.description}</p>
                    </div>
                `;
                
                projectElement.addEventListener('click', () => {
                    // Centrar el mapa en el marcador del proyecto y abrir su popup
                    const marker = projectMarkers[project.id];
                    map.setView(marker.getLatLng(), 15);
                    marker.openPopup();
                    
                    // Resaltar visualmente el proyecto clickeado
                    document.querySelectorAll('.project-card').forEach(el => {
                        el.style.borderLeftWidth = '4px';
                    });
                    projectElement.style.borderLeftWidth = '8px';
                });
                
                container.appendChild(projectElement);
            });
        }

        // Inicializar el mapa y cargar proyectos cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            // Crear el mapa centrado en Buenos Aires
            map = L.map('map').setView([-34.6037, -58.3816], 12);

            // Agregar capas de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);

            // Crear un grupo de capas para contener los marcadores
            markers = L.featureGroup().addTo(map);

            // Agregar un marcador por cada proyecto
            projects.forEach(project => {
                const icon = createCustomIcon(project.category, project.id);
                
                const marker = L.marker(project.coords, { 
                    icon: icon,
                    projectId: project.id
                }).addTo(markers);
                
                marker.bindPopup(createPopupContent(project), { className: 'custom-popup' });
                
                // Guardar referencia al marcador por id de proyecto
                projectMarkers[project.id] = marker;
            });

            // Interceptar clics en el botón del popup para abrir detalles en nueva pestaña
            map.on('popupopen', function(e) {
                const popupEl = e.popup.getElement();
                if (!popupEl) return;
                const btn = popupEl.querySelector('.open-details');
                if (!btn) return;
                btn.addEventListener('click', function(ev) {
                    ev.preventDefault();
                    const url = btn.getAttribute('data-url') || btn.getAttribute('href');
                    window.open(url, '_blank', 'noopener,noreferrer');
                }, { once: true });
            });

            // Inicializar la vista con todos los proyectos
            renderProjects();

            // Manejar clics en pestañas de categoría
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    const category = this.dataset.category;
                    
                    // Actualizar pestaña activa visualmente
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Renderizar proyectos para la categoría seleccionada
                    renderProjects(category);
                    
                    // Ajustar el mapa a los límites de los marcadores de la categoría
                    const categoryProjects = category === 'all' 
                        ? projects 
                        : projects.filter(p => p.category === category);
                    if (categoryProjects.length > 0) {
                        const bounds = L.latLngBounds(categoryProjects.map(p => p.coords));
                        map.flyToBounds(bounds, { padding: [50, 50] });
                    }
                });
            });
        });
        
