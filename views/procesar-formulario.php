<?php
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

    $nombre   = htmlspecialchars(trim($_POST["nombre"]));
    $email    = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST["telefono"]));
    $asunto   = htmlspecialchars(trim($_POST["asunto"]));
    $mensaje  = htmlspecialchars(trim($_POST["mensaje"]));

    if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje)) {
        die("Por favor, complete todos los campos obligatorios.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("La dirección de correo no es válida.");
    }

    $destinatario = "informate@constructorasidco.com";  
    $titulo = "Nuevo mensaje de contacto: " . $asunto;

    $contenido = "Has recibido un nuevo mensaje:\n\n";
    $contenido .= "Nombre: $nombre\n";
    $contenido .= "Email: $email\n";
    $contenido .= "Teléfono: $telefono\n";
    $contenido .= "Asunto: $asunto\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: $nombre <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($destinatario, $titulo, $contenido, $headers)) {
        echo "✅ Gracias $nombre, tu mensaje ha sido enviado correctamente.";
    } else {
        echo "❌ Error: No se pudo enviar el mensaje. Intenta de nuevo más tarde.";
    }
}
