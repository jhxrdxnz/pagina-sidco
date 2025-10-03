
<div class="formulario-container">
  <!-- Mitad izquierda - Formulario -->
  <div class="formulario-izquierda">
    <div class="formulario-header">
      <h1 class="titulo-contacto">Te gustaria trabajar con nosotros?</h1>
      <h1 class="titulo-contacto">¡Queremos conocerte!</h1>
      <p class="subtitulo-contacto">Si querés postularte para otro puesto, completa el siguiente formulario:</p>
    </div>
    
    <div class="formulario-recadro">
      <div class="u-form u-form-1">
        <form action="/Pagina/views/procesar-rrhh.php" 
              method="POST" 
              enctype="multipart/form-data"
              class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" 
              style="padding: 10px;">

          <!-- Primera fila: Nombre y Teléfono -->
          <div class="form-row">
            <div class="u-form-group u-form-name">
              <label for="nombre" class="u-label">Nombre *</label>
              <input type="text" placeholder="Introduzca su nombre" id="nombre" name="nombre" class="u-input u-input-rectangle" required>
            </div>

            <div class="u-form-group">
              <label for="telefono" class="u-label">Teléfono *</label>
              <input type="tel" placeholder="Ej: 11-1234-5678" id="telefono" name="telefono" class="u-input u-input-rectangle" required>
            </div>
          </div>

          <!-- Segunda fila: Localidad y Email -->
          <div class="form-row">
            <div class="u-form-group">
              <label for="localidad" class="u-label">Localidad *</label>
              <input type="text" placeholder="Ciudad o barrio" id="localidad" name="localidad" class="u-input u-input-rectangle" required>
            </div>

            <div class="u-form-email u-form-group">
              <label for="email" class="u-label">Email *</label>
              <input type="email" placeholder="ejemplo@correo.com" id="email" name="email" class="u-input u-input-rectangle" required>
            </div>
          </div>

          <!-- Tercera fila: Área de trabajo (individual) -->
          <div class="u-form-group">
            <label for="area" class="u-label">Área de trabajo *</label>
            <select id="area" name="area" class="u-input u-input-rectangle" required>
              <option value="">Seleccione una opción</option>
              <option value="Administración">Administración</option>
              <option value="RRHH">RRHH</option>
              <option value="Seguridad e Higiene">Seguridad e Higiene</option>
              <option value="Jefatura de Obra">Jefatura de Obra</option>
              <option value="Personal de Obra">Personal de Obra</option>
              <option value="Otro">Otro</option>
            </select>
          </div>

          <!-- Cuarta fila: Remuneración y CV -->
          <div class="form-row">
            <div class="u-form-group">
              <label for="remuneracion" class="u-label">Remuneración esperada (ARS) *</label>
              <input type="number" id="remuneracion" name="remuneracion" min="200000" step="1000" placeholder="Ej: ARS 250000" class="u-input u-input-rectangle" required>
            </div>

            <div class="u-form-group">
              <label for="cv" class="u-label">Envíanos tu CV (PDF o DOC) *</label>
              <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" class="u-input u-input-rectangle" required>
            </div>
          </div>

          <!-- reCAPTCHA -->
          <div class="g-recaptcha" data-sitekey="6LcvYrcrAAAAAAF6c_ocADo7pDYi7C_QAaRpznM5"></div>
          <script src="https://www.google.com/recaptcha/api.js" async defer></script>

          <!-- Botón Enviar y mensaje de campos obligatorios -->
          <div class="submit-section">
            <div class="u-align-left u-form-group u-form-submit">
              <button type="submit" id="btn-enviar" class="u-btn u-btn-submit u-button-style">Enviar</button>
            </div>
            <p class="u-text u-text-default u-text-3">Todos los campos marcados con un (*) son obligatorios.</p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Mitad derecha - Contenido (se puede personalizar o eliminar si no se usa) -->
  <div class="formulario-derecha">
    <div class="contenido-derecha">
      <h2 class="titulo-derecha">¿Por qué postularte?</h2>
      <p class="texto-derecha">
        En nuestra empresa creemos en el talento y la motivación. Ofrecemos oportunidades de desarrollo profesional y un entorno de trabajo dinámico y colaborativo.
      </p>
    </div>
  </div>
</div>

<!-- CSS vinculado -->
<link rel="stylesheet" href="/Pagina/views/css/rrhh.css">

<!-- JavaScript vinculado -->
<script src="/Pagina/views/js/rrhh.js"></script>
