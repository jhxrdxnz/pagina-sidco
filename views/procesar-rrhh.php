<?php
require_once __DIR__ . '/config-smtp.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $recaptcha_secret = "6LcvYrcrAAAAABG9e1JoMI4J-h-Mffd4diUmGO88";
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);

    if ($captcha_success->success == false) {
        die("❌ Verificación reCAPTCHA fallida. Intenta nuevamente.");
    }

    // Obtener y validar los datos del formulario de RRHH
    $nombre        = htmlspecialchars(trim($_POST["nombre"]));
    $telefono      = htmlspecialchars(trim($_POST["telefono"]));
    $email         = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $localidad     = htmlspecialchars(trim($_POST["localidad"]));
    $area          = htmlspecialchars(trim($_POST["area"]));
    $remuneracion  = htmlspecialchars(trim($_POST["remuneracion"]));

    // Validar campos obligatorios
    if (empty($nombre) || empty($telefono) || empty($email) || empty($localidad) || empty($area) || empty($remuneracion)) {
        die("Por favor, complete todos los campos obligatorios.");
    }

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("La dirección de correo no es válida.");
    }

    // Validar remuneración (debe ser un número)
    if (!is_numeric($remuneracion) || $remuneracion < 200000) {
        die("La remuneración debe ser un número válido mayor a ARS 200,000.");
    }

    // Procesar archivo CV
    $cv_info = "";
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $cv_file = $_FILES['cv'];
        $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (!in_array($cv_file['type'], $allowed_types)) {
            die("❌ Error: Solo se permiten archivos PDF, DOC o DOCX para el CV.");
        }
        
        if ($cv_file['size'] > 5 * 1024 * 1024) { // 5MB máximo
            die("❌ Error: El archivo CV es demasiado grande. Máximo 5MB.");
        }
        
        $cv_info = "CV adjunto: " . $cv_file['name'] . " (" . number_format($cv_file['size'] / 1024, 2) . " KB)";
    } else {
        die("❌ Error: Debe adjuntar un archivo CV.");
    }

    $destinatario = $MAIL_TO;  
    $titulo = "Nueva postulación RRHH - Área: " . $area;

    $contenido = "Se ha recibido una nueva postulación para RRHH:\n\n";
    $contenido .= "DATOS PERSONALES:\n";
    $contenido .= "Nombre: $nombre\n";
    $contenido .= "Email: $email\n";
    $contenido .= "Teléfono: $telefono\n";
    $contenido .= "Localidad: $localidad\n\n";
    $contenido .= "INFORMACIÓN LABORAL:\n";
    $contenido .= "Área de trabajo: $area\n";
    $contenido .= "Remuneración esperada: ARS " . number_format($remuneracion, 0, ',', '.') . "\n\n";
    $contenido .= "ARCHIVOS:\n";
    $contenido .= "$cv_info\n\n";
    $contenido .= "Fecha de postulación: " . date('d/m/Y H:i:s') . "\n";
    $contenido .= "IP del remitente: " . $_SERVER['REMOTE_ADDR'] . "\n";

    // Preparar adjunto si existe
    $attachments = [];
    if (isset($cv_file) && is_uploaded_file($cv_file['tmp_name'])) {
        $attachments[] = [
            'path' => $cv_file['tmp_name'],
            'name' => $cv_file['name'],
            'type' => $cv_file['type'] ?: 'application/octet-stream',
        ];
    }

    $multipart = build_multipart_message($titulo, $contenido, $attachments);

    $headers = [];
    $headers[] = 'From: ' . $MAIL_FROM_NAME . ' <' . $MAIL_FROM . '>';
    $headers[] = 'Reply-To: ' . $email;
    $headers[] = $multipart['headers'];

    if (mail($destinatario, $titulo, $multipart['body'], implode("\r\n", $headers))) {
        echo "✅ ¡Gracias $nombre! Tu postulación ha sido enviada correctamente. Nos pondremos en contacto contigo pronto.";
    } else {
        echo "❌ Error: No se pudo enviar la postulación. Intenta de nuevo más tarde.";
    }
}
?>
