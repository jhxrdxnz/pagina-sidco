<?php
$base = '/Pagina/'; // Ruta base del proyecto desde la raíz del servidor web
$logoSrc = $base . 'views/images/logosidco.png';
$homeHref = $base . 'index.php';
?>

<header class="u-header" id="header">
  <div class="u-sheet u-valign-middle" style="min-height: 118px; display: flex; align-items: center; justify-content: space-between;">
    
    <!-- Logo -->
    <a href="<?php echo $homeHref; ?>" class="u-logo" style="display: block; width: 266px; height: 58px;">
      <img src="<?php echo $logoSrc; ?>" alt="Principal" style="width: 100%; height: 100%;" >
    </a>

    <!-- Menú -->
    <nav class="u-menu" role="navigation" style="display:flex; align-items:center; gap:16px;">
      <div class="menu-collapse">
        <a class="u-hamburger-link" aria-label="Abrir menú" aria-controls="menu-mobile" href="#">
          <svg viewBox="0 0 16 16" width="24" height="24">
            <rect y="1" width="16" height="2"></rect>
            <rect y="7" width="16" height="2"></rect>
            <rect y="13" width="16" height="2"></rect>
          </svg>
        </a>
      </div>
      <ul class="u-nav" >
        <li><a href=" <?php echo $base; ?>portfolio.php">Galería</a></li>
        <li><a href=" <?php echo $base; ?>Novedades.php">Novedades</a></li>
        <li><a href=" <?php echo $base; ?>Recursos-Humanos.php">Recursos Humanos</a></li>
        <li><a href=" <?php echo $base; ?>contacto.php">Contacto</a></li>
        <li><a href="#suscribirse" class="open-subscribe" role="button" aria-controls="subscribeOverlay">Suscribirse</a></li>
      </ul>

      <!-- Toggle tema (Uiverse.io by RiccardoRapelli) -->
      <label class="switch" title="Cambiar tema">
        <input id="themeCheckbox" type="checkbox" aria-label="Cambiar tema" />
        <div class="slider round">
          <div class="sun-moon">
            <svg id="moon-dot-1" class="moon-dot" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="moon-dot-2" class="moon-dot" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="moon-dot-3" class="moon-dot" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="light-ray-1" class="light-ray" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="light-ray-2" class="light-ray" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="light-ray-3" class="light-ray" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>

            <svg id="cloud-1" class="cloud-dark" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="cloud-2" class="cloud-dark" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="cloud-3" class="cloud-dark" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="cloud-4" class="cloud-light" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="cloud-5" class="cloud-light" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
            <svg id="cloud-6" class="cloud-light" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="50"></circle>
            </svg>
          </div>
          <div class="stars">
            <svg id="star-1" class="star" viewBox="0 0 20 20">
              <path d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
            </svg>
            <svg id="star-2" class="star" viewBox="0 0 20 20">
              <path d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
            </svg>
            <svg id="star-3" class="star" viewBox="0 0 20 20">
              <path d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
            </svg>
            <svg id="star-4" class="star" viewBox="0 0 20 20">
              <path d="M 0 10 C 10 10,10 10 ,0 10 C 10 10 , 10 10 , 10 20 C 10 10 , 10 10 , 20 10 C 10 10 , 10 10 , 10 0 C 10 10,10 10 ,0 10 Z"></path>
            </svg>
          </div>
        </div>
      </label>
    </nav>

  </div>
</header>
<?php include_once __DIR__ . '/subscribirse.php'; ?>
