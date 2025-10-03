<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Principal</title>
  
  <!-- ===== DEPENDENCIAS EXTERNAS ===== -->
  <!-- Bootstrap CSS Framework -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
  <!-- ===== CSS PERSONALIZADO ===== -->
  <!-- Estilos principales de la página -->
  <link href="views/css/index.css" rel="stylesheet">
  <!-- Estilos del header/navegación -->
  <link href="views/css/header.css" rel="stylesheet">
  <!-- Estilos del footer -->
  <link rel="stylesheet" href="views/css/footer.css">
  <!-- Overrides de tema (claro/oscuro) - debe ir al final -->
  <link href="views/css/theme.css" rel="stylesheet">
  
</head>
<body class="bg-dark">

<!-- ===== COMPONENTES REUTILIZABLES ===== -->
<!-- Header/Navegación principal -->
<?php include 'views/header.php'; ?>

<!-- Carrusel principal con efecto typing -->
<?php include 'views/carrusel.php'; ?>

<!-- ===== SECCIÓN 1: BANNER INFORMATIVO ===== -->
<!-- Franja horizontal con mensaje destacado -->
<div class="home-banner">
  <div class="container">
    <div class="home-banner__text">La forma más eficiente de ver sus proyectos finalizados</div>
  </div>
</div>

<!-- ===== SECCIÓN 2: VIDEO DESTACADO ===== -->
<!-- Video promocional/institucional en formato 16:9 -->

<!--
  <section class="home-video" aria-label="Video destacado">
    <div class="container">
      <div class="video-wrapper">
        <iframe 
          class="video-frame"
          width="560"
          height="315"
          src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&rel=0&controls=0&showinfo=0&modestbranding=1"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </section> 
-->

<!-- ===== SECCIÓN 3: SOBRE NOSOTROS ===== -->
<!-- Layout 40/60 con imagen semicircular y texto descriptivo -->
<section class="home-about" aria-label="Creemos en lo simple, lo claro y lo útil.">
  <div class="container-fluid">
    <div class="about-grid">
      <!-- Bloque de imagen (40% del ancho) -->
      <div class="about-image-block">
        <!-- Imagen semicircular con fondo de imagen -->
        <div class="about-image" role="img" aria-label="Imagen institucional"></div>
      </div>
      <!-- Bloque de texto (60% del ancho) -->
      <div class="about-text-block">
        <div class="about-text-inner">
          <h2 class="about-title">Creemos en lo simple, lo claro y lo útil.</h2>
          <p class="about-text">En SIDCO encontrará una empresa de ingeniería y construcciones formada por profesionales altamente comprometidos con su función, que brindan en todas las etapas de los proyectos un sistema integral de soluciones, abarcando todos los servicios necesarios para la materialización, puesta en marcha y mantenimiento de obras.
                                En todos nuestros servicios nos enfocamos a brindar soluciones constructivas y de ingeniería, desde hace más de 10 años, en obras civiles e industriales, de infraestructura urbana y regional.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== SECCIÓN 5: CARRUSEL DE PROYECTOS ===== -->
<!-- Carrusel con vista previa: 3 imágenes simultáneas con efecto de deslizamiento -->
<section class="home-features" aria-label="Nuestros Proyectos">
  <div class="container-fluid">
    <div class="features-horizontal-carousel">
      <!-- Título principal de la sección -->
      <h2 class="features-main-title">Hacemos que lo imposible sea posible</h2>
      
      <!-- Contenedor principal del carrusel -->
      <div class="cycle-carousel-container">
        <div class="cycle-carousel-wrapper">
          <!-- Track del carrusel con 3 elementos visibles -->
          <div class="cycle-carousel-track" id="cycleCarousel">
            
            <!-- Imagen anterior (índice 4) -->
            <div class="cycle-item cycle-item-prev" data-index="4">
              <div class="cycle-image" style="background-image: url('https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop');" role="img" aria-label="Proyectos Industriales"></div>
              <div class="cycle-text">
                <h3>Proyectos Industriales</h3>
                <p>Edificios Residenciales y Comerciales.
                Construcción de viviendas, oficinas y espacios comerciales.
                Calidad, seguridad y cumplimiento de plazos.</p>
              </div>
            </div>

            <!-- Imagen actual (índice 0) -->
            <div class="cycle-item cycle-item-active" data-index="0">
              <div class="cycle-image" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=400&h=300&fit=crop');" role="img" aria-label="Redes de Gas Natural"></div>
              <div class="cycle-text">
                <h3>Redes de Gas Natural</h3>
                <p>Diseño e instalación de redes de distribución de gas natural y plantas reguladoras.
                Garantizamos eficiencia, seguridad y cumplimiento normativo.</p>
              </div>
            </div>

            <!-- Imagen siguiente (índice 1) -->
            <div class="cycle-item cycle-item-next" data-index="1">
              <div class="cycle-image" style="background-image: url('https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop');" role="img" aria-label="Electricidad, Iluminación y Fibra Óptica"></div>
              <div class="cycle-text">
                <h3>Electricidad, Iluminación y Fibra Óptica</h3>
                <p>Desarrollo de redes eléctricas urbanas, sistemas de iluminación LED y tendido de fibra óptica.
                Conectividad y energía para ciudades más inteligentes.</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- ===== DATOS DEL CARRUSEL ===== Modificar las URL para agregar las imagenes--> 
        <!-- Contenedor oculto con todos los datos de las imágenes para el JavaScript -->
        <div class="cycle-data-container" style="display: none;">
          <div class="cycle-data-item" data-index="0" data-image="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=400&h=300&fit=crop" data-title="Redes de Gas Natural" data-description="Diseño e instalación de redes de distribución de gas natural y plantas reguladoras.
          Garantizamos eficiencia, seguridad y cumplimiento normativo."></div>
          <div class="cycle-data-item" data-index="1" data-image="https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop" data-title="Electricidad, Iluminación y Fibra Óptica" data-description="Desarrollo de redes eléctricas urbanas, sistemas de iluminación LED y tendido de fibra óptica.
          Conectividad y energía para ciudades más inteligentes."></div>
          <div class="cycle-data-item" data-index="2" data-image="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop" data-title="Obras Hidráulicas y Saneamiento" data-description="Ejecución de redes de agua potable, desagües pluviales y cloacales.
          Comprometidos con el cuidado del medio ambiente y la salud pública."></div>
          <div class="cycle-data-item" data-index="3" data-image="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop" data-title="Urbanizaciones Integrales" data-description="Soluciones completas: desde el movimiento de suelo hasta la instalación de todos los servicios.
          Transformamos terrenos en comunidades habitables y funcionales."></div>
          <div class="cycle-data-item" data-index="4" data-image="https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop" data-title="Proyectos Industriales" data-description="Edificios Residenciales y Comerciales.
          Construcción de viviendas, oficinas y espacios comerciales.
          Calidad, seguridad y cumplimiento de plazos."></div>
        </div>
        
        <!-- ===== CONTROLES DEL CARRUSEL ===== -->
        <!-- Botones de navegación lateral -->
        <button class="cycle-carousel-btn cycle-carousel-btn-prev" id="cyclePrevBtn">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="cycle-carousel-btn cycle-carousel-btn-next" id="cycleNextBtn">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
      
      <!-- Indicadores de posición (puntos) -->
      <div class="horizontal-carousel-indicators">
        <span class="horizontal-indicator active" data-slide="0"></span>
        <span class="horizontal-indicator" data-slide="1"></span>
        <span class="horizontal-indicator" data-slide="2"></span>
        <span class="horizontal-indicator" data-slide="3"></span>
        <span class="horizontal-indicator" data-slide="4"></span>
      </div>
    </div>
  </div>
</section>

<br class="a">
<br>
<br>

<!-- ===== SECCIÓN 6: PILARES FUNDAMENTALES ===== -->
<section class="home-pillars section-fullwidth text-light">
  <div class="container text-center">
    <!-- Título principal de la sección -->
    <h2 class="features-main-title">La base de todo</h2>
    <h2 class="pillar-title"><em>Son nuestros pilares</em></h2>
  </div>

  <div class="row no-gutters">
    <!-- Pilar 1 -->
    <div class="col-lg-4 pillar-block pillar1">
      <h2 class="pillar-title">Honestidad</h2>
      <h3 class="pillar-title">Subtítulo</h3>
      <p class="pillar-text">
        Somos un grupo de personas dedicadas a <strong>HACER REALIDAD OBRAS COMPLEJAS</strong>
        entregando resultados que superen las expectativas de nuestros clientes.<br>
        Nos moviliza el desafío de trabajar en equipo con todos los involucrados 
        <strong>GENERANDO APRENDIZAJE Y CRECIMIENTO</strong> en cada uno de ellos.<br>
        Creemos que la gran diferencia se logra 
        <strong>PONIENDO EL FOCO EN LOS PEQUEÑOS DETALLES</strong>.
      </p>
    </div>

    <!-- Pilar 2 -->
    <div class="col-lg-4 pillar-block pillar2">
      <h2 class="pillar-title">Ética</h2>
      <h3 class="pillar-title">Subtítulo</h3>
      <p class="pillar-text">
        - Planificar y ejecutar obras complejas con resultados increíbles.<br>
        - Armar equipos de trabajo positivos, confiados, confiables y con una meta en común.<br>
        - Construir relaciones sólidas a largo plazo.
      </p>
    </div>

    <!-- Pilar 3 -->
    <div class="col-lg-4 pillar-block pillar3">
      <h2 class="pillar-title">Creatividad</h2>
      <h3 class="pillar-title">Subtítulo</h3>
      <p class="pillar-text">
        - <strong>RESPETO</strong> como base de todos los proyectos y acuerdos.<br>
        - <strong>ENTUSIASMO</strong> a la hora de trabajar.<br>
        - Espíritu de <strong>SUPERACIÓN</strong> en cada desafío.<br>
        - <strong>MOTIVACIÓN</strong> en los equipos de trabajo.<br>
        - Búsqueda de <strong>SOLUCIONES</strong> constante.<br>
        - <strong>VERSATILIDAD</strong> para adaptarse a los cambios.<br>
        - <strong>IDONEIDAD</strong> y <strong>EFICACIA</strong> en los grupos de trabajo.<br>
        - <strong>INTEGRIDAD</strong> en nuestras acciones y toma de decisiones.
      </p>
    </div>
  </div>
</section>


<!-- ===== SECCIÓN 7: LÍNEA DE TIEMPO DE OBRAS ===== -->
<!-- CDN Dependencies -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<!-- Custom timeline styles -->
<link rel="stylesheet" href="views/css/timeline.css">

<section class="py-20 px-4" aria-label="Línea de tiempo de obras">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4" style="color: var(--text-color);">Nuestras Obras Más Importantes</h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: var(--text-light);">Explora nuestro recorrido de éxito a través de los años</p>
        </div>

        <div class="relative">
            <!-- Timeline Progress Bar -->
            <div class="h-1 bg-gray-200 rounded-full mb-16 relative">
                <div class="timeline-progress absolute top-0 left-0 h-full rounded-full"></div>
                <div class="absolute top-0 left-0 w-full h-full flex justify-between items-center">
                    <div class="relative">
                        <div class="timeline-point" data-index="0"></div>
                        <div class="timeline-year-marker" style="color: var(--text-color);">2019</div>
                    </div>
                    <div class="relative">
                        <div class="timeline-point" data-index="1"></div>
                        <div class="timeline-year-marker" style="color: var(--text-color);">2020</div>
                    </div>
                    <div class="relative">
                        <div class="timeline-point" data-index="2"></div>
                        <div class="timeline-year-marker" style="color: var(--text-color);">2021</div>
                    </div>
                    <div class="relative">
                        <div class="timeline-point" data-index="3"></div>
                        <div class="timeline-year-marker" style="color: var(--text-color);">2022</div>
                    </div>
                    <div class="relative">
                        <div class="timeline-point" data-index="4"></div>
                        <div class="timeline-year-marker" style="color: var(--text-color);">2023</div>
                    </div>
                </div>
            </div>

            <!-- Timeline Content -->
            <div class="relative overflow-hidden h-[500px]">
                <!-- Slides -->
                <div class="timeline-slide active" data-index="0">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="timeline-image-block" data-aos="fade-right">
                            <div class="timeline-image" style="background-image: url('views/Obras/images/las moradas/DJI_0418.jpg');"></div>
                        </div>
                        <div class="timeline-info-block" data-aos="fade-left">
                            <h3 class="text-2xl font-bold mb-2" style="color: var(--text-color);">Centro Comercial Integral</h3>
                            <p class="font-medium mb-4" style="color: var(--primary-color);">2019</p>
                            <p class="mb-6" style="color: var(--text-light);">Un ambicioso proyecto comercial que transformó el paisaje urbano, combinando espacios de retail, entretenimiento y gastronomía en un diseño arquitectónico innovador.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="timeline-detail">Área: 8,000 m²</span>
                                <span class="timeline-detail">Duración: 36 meses</span>
                                <span class="timeline-detail">Ubicación: La Plata</span>
                            </div>
                            <button class="mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
                                Ver detalles <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-slide" data-index="1">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="timeline-image-block">
                            <div class="timeline-image" style="background-image: url('views/Obras/images/las%20moradas/IMG_7843.jpg');"></div>
                        </div>
                        <div class="timeline-info-block">
                            <h3 class="text-2xl font-bold mb-2" style="color: var(--text-color);">Sistema Hidráulico Urbano</h3>
                            <p class="font-medium mb-4" style="color: var(--primary-color);">2020</p>
                            <p class="mb-6" style="color: var(--text-light);">Infraestructura crítica para el manejo de aguas pluviales que resolvió problemas de inundaciones crónicas en la zona urbana.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="timeline-detail">Capacidad: 50,000 m³</span>
                                <span class="timeline-detail">Duración: 20 meses</span>
                                <span class="timeline-detail">Ubicación: Mendoza</span>
                            </div>
                            <button class="mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
                                Ver detalles <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-slide" data-index="2">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="timeline-image-block">
                            <div class="timeline-image" style="background-image: url('views/Obras/images/las%20moradas/IMG_7851.jpg');"></div>
                        </div>
                        <div class="timeline-info-block">
                            <h3 class="text-2xl font-bold mb-2" style="color: var(--text-color);">Infraestructura Vial Principal</h3>
                            <p class="font-medium mb-4" style="color: var(--primary-color);">2021</p>
                            <p class="mb-6" style="color: var(--text-light);">Modernización completa de la red vial principal, incluyendo puentes elevados y sistemas de señalización inteligente.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="timeline-detail">Longitud: 15 km</span>
                                <span class="timeline-detail">Duración: 30 meses</span>
                                <span class="timeline-detail">Ubicación: Rosario</span>
                            </div>
                            <button class="mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
                                Ver detalles <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-slide" data-index="3">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="timeline-image-block">
                            <div class="timeline-image" style="background-image: url('views/Obras/images/las%20moradas/IMG_7904.jpg');"></div>
                        </div>
                        <div class="timeline-info-block">
                            <h3 class="text-2xl font-bold mb-2" style="color: var(--text-color);">Complejo Industrial Moderno</h3>
                            <p class="font-medium mb-4" style="color: var(--primary-color);">2022</p>
                            <p class="mb-6" style="color: var(--text-light);">Un centro industrial de última generación diseñado para operaciones logísticas eficientes, con certificación LEED.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="timeline-detail">Área: 5,200 m²</span>
                                <span class="timeline-detail">Duración: 24 meses</span>
                                <span class="timeline-detail">Ubicación: Córdoba</span>
                            </div>
                            <button class="mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
                                Ver detalles <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-slide" data-index="4">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="timeline-image-block">
                            <div class="timeline-image" style="background-image: url('views/Obras/images/las%20moradas/DJI_0418.jpg');"></div>
                        </div>
                        <div class="timeline-info-block">
                            <h3 class="text-2xl font-bold mb-2" style="color: var(--text-color);">Obra Residencial Premium</h3>
                            <p class="font-medium mb-4" style="color: var(--primary-color);">2023</p>
                            <p class="mb-6" style="color: var(--text-light);">Conjunto residencial de alta gama con amenities de lujo y tecnología smart home integrada.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="timeline-detail">Área: 2,500 m²</span>
                                <span class="timeline-detail">Duración: 18 meses</span>
                                <span class="timeline-detail">Ubicación: Buenos Aires</span>
                            </div>
                            <button class="mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 flex items-center">
                                Ver detalles <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8">
                <button class="timeline-nav-btn prev-btn text-gray-700 hover:text-white">
                    <i data-feather="chevron-left"></i>
                </button>
                <button class="timeline-nav-btn next-btn text-gray-700 hover:text-white">
                    <i data-feather="chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<!-- Pie de página con información de contacto y enlaces -->
<?php include 'views/footer.php'; ?>

<!-- ===== SCRIPTS JAVASCRIPT ===== -->
<!-- Bootstrap JS Framework -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scripts personalizados -->
<script src="views/js/header.js"></script>          <!-- Funcionalidad del header/navegación -->
<script src="views/js/carousel-typing.js"></script> <!-- Efecto de escritura automática -->
<script src="views/js/cycle-carousel.js"></script>  <!-- Carrusel de proyectos con vista previa -->
<script src="views/js/timeline.js"></script>        <!-- Línea de tiempo interactiva de obras -->
<script src="views/js/footer.js"></script>          <!-- Funcionalidad del footer -->

</body>
</html>