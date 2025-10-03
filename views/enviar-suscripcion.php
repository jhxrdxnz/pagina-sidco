<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Método no permitido';
    exit;
}

require_once __DIR__ . '/config-smtp.php';

$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email  = isset($_POST['email']) ? trim($_POST['email']) : '';
$acepta = isset($_POST['terminos']) && ($_POST['terminos'] === 'on' || $_POST['terminos'] === '1');

if ($nombre === '' || $email === '' || !$acepta) {
    http_response_code(400);
    echo 'Completá nombre, email y aceptá los términos.';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo 'El email no es válido.';
    exit;
}

$subject = 'Nueva suscripción a novedades';
$contenido = "Nueva suscripción recibida:\n\n";
$contenido .= "Nombre: $nombre\n";
$contenido .= "Email: $email\n";
$contenido .= "Fecha: " . date('d/m/Y H:i:s') . "\n";
$contenido .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'N/D') . "\n";

$headers = [];
$headers[] = 'From: ' . $MAIL_FROM_NAME . ' <' . $MAIL_FROM . '>';
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
$headers[] = 'X-Mailer: PHP/' . phpversion();

$ok = @mail($MAIL_TO, $subject, $contenido, implode("\r\n", $headers));

if ($ok) {
    echo '✅ ¡Gracias por suscribirte!';
} else {
    http_response_code(500);
    echo '❌ No se pudo enviar tu suscripción. Intentalo más tarde.';
}

