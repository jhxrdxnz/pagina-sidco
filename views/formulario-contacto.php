<!-- formulario-contacto.php -->
<div class="formulario-container">
  <!-- Mitad izquierda - Formulario -->
  <div class="formulario-izquierda">
    <div class="formulario-header">
      <h1 class="titulo-contacto">¡Contáctanos!</h1>
      <p class="subtitulo-contacto">Solicite más información...</p>
    </div>
    
    <div class="formulario-recadro">
      <div class="u-form u-form-1">
        <form action="/Pagina/views/procesar-formulario.php" 
              method="POST" 
              class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" 
              style="padding: 10px;">
              
          <div class="u-form-group u-form-name">
            <label for="nombre" class="u-label">Nombre *</label>
            <input type="text" placeholder="Introduzca su nombre" id="nombre" name="nombre" class="u-input u-input-rectangle" required>
          </div>
          
          <div class="u-form-email u-form-group">
            <label for="email" class="u-label">Email *</label>
            <input type="email" placeholder="Introduzca una dirección de correo electrónico válida" id="email" name="email" class="u-input u-input-rectangle" required>
          </div>
          
          <div class="u-form-group u-form-group-3">
            <label for="telefono" class="u-label">Teléfono</label>
            <input type="text" placeholder="Introduzca un número de teléfono válido" id="telefono" name="telefono" class="u-input u-input-rectangle">
          </div>
          
          <div class="u-form-group u-form-group-4">
            <label for="asunto" class="u-label">Asunto *</label>
            <input type="text" placeholder="Introduzca un asunto" id="asunto" name="asunto" class="u-input u-input-rectangle" required>
          </div>
          
          <div class="u-form-group u-form-message">
            <label for="mensaje" class="u-label">Mensaje *</label>
            <textarea placeholder="Ingrese su mensaje" rows="4" cols="50" id="mensaje" name="mensaje" class="u-input u-input-rectangle" required></textarea>
          </div>
          <div class="g-recaptcha" data-sitekey="6LcvYrcrAAAAAAF6c_ocADo7pDYi7C_QAaRpznM5"></div>

          <script src="https://www.google.com/recaptcha/api.js" async defer></script>

          <div class="u-align-left u-form-group u-form-submit">
            <button type="submit" class="u-btn u-btn-submit u-button-style">Enviar</button>
          </div>
        </form>
      </div>
      <p class="u-text u-text-default u-text-3">Todos los campos marcados con un (*) son obligatorios.</p>
    </div>
  </div>
  
  <!-- Mitad derecha - Contenido -->
  <div class="formulario-derecha">
    <div class="contenido-derecha">
      <h2 class="titulo-derecha">Nuestra Empresa</h2>
      <p class="texto-derecha">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      </p>
      <p class="texto-derecha">
        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
      </p>
      <p class="texto-derecha">
        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.
      </p>
    </div>
  </div>
</div>

<link rel="stylesheet" href="views/css/contacto.css">
